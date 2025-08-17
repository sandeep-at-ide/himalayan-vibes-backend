<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // User selection
            Forms\Components\Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->required()
                ->searchable()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                ])
                ->createOptionUsing(function (array $data) {
                    return \App\Models\User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => \Illuminate\Support\Facades\Hash::make('password'), // default password
                    ]);
                }),

            // Package selection
            Forms\Components\Select::make('package_id')
                ->label('Package')
                ->relationship('package', 'title')
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state) {
                    $package = Package::find($state);
                    $set('package_price', $package?->price ?? 0);
                }),

            // Auto-filled package price
            Forms\Components\TextInput::make('package_price')
                ->label('Package Price')
                ->numeric()
                ->disabled()
                ->required(),

            Forms\Components\DatePicker::make('booking_date')
                ->label('Booking Date')
                ->minDate(now())
                ->required(),

            Forms\Components\TextInput::make('number_of_people')
                ->label('Number of People')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('vat_amount')
                ->label('VAT Amount')
                ->numeric()
                ->nullable(),

            Forms\Components\TextInput::make('discount')
                ->label('Discount')
                ->numeric()
                ->nullable(),

            Forms\Components\TextInput::make('total_price')
                ->label('Total Price')
                ->numeric()
                ->nullable(),

            Forms\Components\Select::make('status')
                ->required()
                ->options([
                    'pending' => 'Pending',
                    'reviewed' => 'Reviewed',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'replied' => 'Replied',
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('package.title')
                    ->label('Package')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('booking_date')
                    ->date()
                    ->label('Booking Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('number_of_people')
                    ->label('People')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('package_price')
                    ->label('Price')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('vat_amount')
                    ->label('VAT')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount')
                    ->label('Discount')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Updated')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add Relation Managers here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
