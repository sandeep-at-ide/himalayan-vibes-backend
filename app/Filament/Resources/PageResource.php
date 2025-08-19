<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->maxLength(255)
                    ->lazy()
                    ->required() 
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->columnSpanFull(),
                Forms\Components\Section::make('SEO')
                    ->collapsible() 
                    ->relationship('seoSetting')
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
                Forms\Components\Section::make('custom_fields')
                ->label('Custom Data Fields for Pages')
                ->schema([
                // Forms\Components\KeyValue::make('custom_fields')
                //     ->nullable()
                //     ->label('Custom Data Fields for Pages') // Labeling as "Pages-specific"
                //     ->helperText('Add unstructured key-value data specific to this page.')
                //     ->columnSpanFull(),

                 // Add specific fields for Pages table
                Forms\Components\TextInput::make('custom_fields.page_title')
                    ->label('Page Title')
                    ->maxLength(255)
                    ->nullable()
                    // ->when(fn($get) => $get('page_type') === 'standard'), // Show for specific page types
,
                Forms\Components\MarkdownEditor::make('custom_fields.page_content')
                    ->label('Page Content')
                    ->nullable()
                    // ->when(fn($get) => $get('page_type') === 'standard'), // Show for specific page types
                ]),
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
                Tables\Columns\TextColumn::make('seo.meta_title')
                    ->label('SEO Title')
                    ->searchable() // Can search through related SEO titles
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
     public static function getNavigationGroup(): ?string
    {
        return 'Content Management';  // assign appropriate group name
    }

    public static function getNavigationGroupIcon(): ?string
    {
        return 'heroicon-o-document-text'; // optional: icon for the group
    }
}
