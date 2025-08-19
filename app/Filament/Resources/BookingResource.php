<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Package;
use Filament\Forms\Components;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\Status;

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
                ->afterStateUpdated(function (callable $set, $state, callable $get) {
                    $package = \App\Models\Package::find($state);

                    $price = $package?->price ?? 0;
                    $vat = round($price * 0.13, 2); // 13% VAT

                    $discount = $get('discount') ?? 0;
                    $total = ($price + $vat);

                    $set('package_price', $price);
                    $set('vat_amount', $vat);
                    $set('total_price', round($total, 2));
                })
,

            Forms\Components\TextInput::make('package_price')
                ->label('Package Price')
                ->numeric()
                ->disabled()    
                ->default(0),

            Forms\Components\TextInput::make('vat_amount')
                ->label('VAT Amount (13%)')
                ->numeric()
                ->disabled()
                ->step(0.01)
                ->default(0)
                ->required(),

            Forms\Components\TextInput::make('discount')
                ->label('Discount')
                ->numeric()
                ->step(0.01)
                ->default(0)
                ->reactive()  // Make the field reactive
                ->afterStateUpdated(function (callable $set, callable $get, $state) {
                    // Ensure that we don't get null or empty values
                    $price = $get('package_price') ?? 0;
                    $vat = $get('vat_amount') ?? 0;
                    $discount = $state ?? 0; // Default to 0 if state is null

                    // Calculate total price
                    $total = ($price + $vat) - $discount;
                    $set('total_price', round($total, 2));  // Set the total price value
                }),

            Forms\Components\TextInput::make('total_price')
                ->label('Total Price')
                ->numeric()
                ->readOnly()  // You can keep it disabled if needed
                ->default(0)
                ->required(),
            Forms\Components\DatePicker::make('booking_date')
                ->label('Booking Date')
                ->required()  // Make the field required, or you can remove this if not needed
                ->default(now())  // Set the default value to the current date
                ->reactive()  // Enable dynamic updating if needed
                ->minDate(now())  // Optionally restrict the selection to today's date or later
                ->helperText('Please select a date for booking'),  // Optional helper text


            Forms\Components\Select::make('status')
                ->required()
                ->options(Status::options())
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

                // Tables\Columns\TextColumn::make('package_price')
                //     ->label('Price')
                //     ->numeric()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('vat_amount')
                //     ->label('VAT')
                //     ->numeric()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('discount')
                //     ->label('Discount')
                //     ->numeric()
                //     ->sortable(),

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
