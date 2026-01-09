<?php

namespace App\Filament\Resources\Suggestions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class SuggestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('book_id')
                    ->relationship('book', 'id'),
                Select::make('coffe_id')
                    ->relationship('coffee', 'id')
                    ->label('Coffee'),
                Select::make('activity_id')
                    ->relationship('activity', 'id'),
                FileUpload::make('icon')
                    ->image()
                    ->directory('suggestions/icons')
                    ->visibility('public')
                    ->label('Icon Image'),
                Select::make('mood_id')
                    ->relationship('mood', 'id')
                    ->required(),
            ]);
    }
}
