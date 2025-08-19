<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->maxLength(255)
                    ->lazy() 
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('itineraries')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->numeric()              // Ensures the input is numeric
                    ->prefix('NPR')          // Adds a prefix to the input field (e.g., NPR 100)
                    ->rules(['min:0'])                  // Ensures the value is not less than 0
                    ->required()             // Optional: you can make the field required
                    ->step(0.01)             // Optional: allows decimal values if needed
                    ->helperText('Enter a valid price in NPR currency'), // Optional: Add a helper text

                Forms\Components\Select::make('location')
                    ->relationship('destination', 'name')
                    ->required(),
                Forms\Components\TextInput::make('duration_days')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('available_spots')
                    ->numeric(),
                Forms\Components\FileUpload::make('image_url')
                    ->directory('packages/featured-images') // Specify storage directory
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make('created_by')
                    // ->default(fn () => Auth::id())
                    ->disabled()
                    ->numeric(),
                Forms\Components\Section::make('SEO')
                    ->collapsible() 
                    ->relationship('seoSettings')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(100)
                            ->nullable(),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->maxLength(255)
                            ->nullable(),

                        Forms\Components\TextInput::make('custom_fields.canonical_url')
                            ->label('Canonical URL')
                            ->maxLength(500)
                            ->nullable()
                            ->url(), 

                        Forms\Components\TextInput::make('custom_fields.robots')
                            ->label('Robots Tag') 
                            ->maxLength(50)
                            ->nullable()
                            ->helperText('e.g., index, follow or noindex, nofollow'),

                        Forms\Components\Textarea::make('custom_fields.schema_markup')
                            ->label('Schema Markup (JSON-LD)')
                            ->rows(6)
                            ->nullable()
                            ->helperText('Add raw JSON-LD schema markup.'),

                        Forms\Components\Repeater::make('custom_fields.og_json')
                            ->label('Open Graph Tags (for Social Sharing)')
                            ->schema([
                                Forms\Components\TextInput::make('property')
                                    ->label('Property')
                                    ->required()
                                    ->maxLength(100)
                                    ->helperText('e.g., og:title, og:image, og:description, og:url, og:type'),
                                Forms\Components\TextInput::make('content')
                                    ->label('Content')
                                    ->required()
                                    ->maxLength(255), 
                            ])
                            ->addActionLabel('Add Open Graph Tag')
                            ->columnSpanFull()
                            ->columns(2)
                            ->collapsible()
                            ->cloneable(), 


                        Forms\Components\Repeater::make('custom_fields.social_media')
                            ->label('Social Media Metadata')
                            ->schema([
                                Forms\Components\TextInput::make('platform')
                                    ->label('Platform')
                                    ->required()
                                    ->maxLength(100)
                                    ->helperText('e.g., Twitter, Facebook, Instagram, product:price:amount, product:price:currency'), // Add product schema examples
                                Forms\Components\TextInput::make('value')
                                    ->label('Value')
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('e.g., @yourhandle, https://facebook.com/yourpage, 19.99, USD'),
                            ])
                            ->addActionLabel('Add Social Media Entry')
                            ->columnSpanFull()
                            ->columns(2)
                            ->collapsible()
                             ->cloneable(),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_days')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('available_spots')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('seo_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
     public static function getNavigationGroup(): ?string
    {
        return 'Content Management';  // assign appropriate group name
    }

    public static function getNavigationGroupIcon(): ?string
    {
        return 'heroicon-o-briefcase'; // optional: icon for the group
    }
}
