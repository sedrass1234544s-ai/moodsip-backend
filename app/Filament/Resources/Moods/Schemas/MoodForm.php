<?php

namespace App\Filament\Resources\Moods\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MoodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_ar')
                    ->required(),
                TextInput::make('name_en')
                    ->required(),
                FileUpload::make('icon')
                    ->image()
                    ->directory('moods/icons')
                    ->visibility('public')
                    ->label('Icon Image'),
            ]);
    }
}
