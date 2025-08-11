<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use App\Models\TeamMember; // Import the User model for the author relation
use App\Models\SeoSetting; // Import the SeoSetting model for SEO metadata
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;

class BlogResource extends Resource
{
    // Define the model
    protected static ?string $model = Blog::class;

    // Define the icon for navigation
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Form Schema for Creating or Editing Blogs
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Slug (URL-friendly version of the title)
                TextInput::make('slug')
                    ->required()
                    ->unique(Blog::class, 'slug')
                    ->maxLength(255)
                    ->columnSpan(2),

                // Title of the blog post
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                // Content of the blog post
                Textarea::make('content')
                    ->required()
                    ->maxLength(65535),

                // Author of the blog post (relationship to User model)
                Select::make('author_id')
                    ->label('Author')
                    ->required()
                    ->relationship('author', 'name')
                    ->searchable()
                    ->options(TeamMember::all()->pluck('name', 'id')),

                // SEO settings for the blog post (relationship to SeoSetting model)
                Select::make('seo_id')
                    ->label('SEO Settings')
                    ->relationship('seo', 'meta_title')
                    ->searchable()
                    ->options(SeoSetting::all()->pluck('meta_title', 'id')),

                // Timestamp for when the blog is published
                DateTimePicker::make('published_at')
                    ->required()
                    ->default(now())
                    ->label('Published At')
                    ->columnSpan(1),
            ]);
    }

    // Table for displaying blogs in the admin panel
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Slug column
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                // Title column
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(100),

                // Author column (linked to the User model)
                BadgeColumn::make('author.name')
                    ->label('Author')
                    ->sortable()
                    ->color('primary')
                    ->searchable(),

                // Published date column
                TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->searchable(),
            ])
            // ->filters([
            //     // Filter for Author
            //     SelectFilter::make('author_id')
            //         ->label('Author')
            //         ->options(User::all()->pluck('name', 'id'))
            //         ->filter(function ($query, $value) {
            //             return $query->where('author_id', $value);
            //         }),
            // ])
            ->actions([
                // Action to Edit the blog
                EditAction::make(),
            ])
            ;
    }

    // Define Relations (for related models)
    public static function getRelations(): array
    {
        return [
            // You can add any related models here if needed
        ];
    }

    // Define Pages for the Blog Resource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
