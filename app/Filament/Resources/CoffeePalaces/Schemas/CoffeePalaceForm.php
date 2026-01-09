<?php

namespace App\Filament\Resources\CoffeePalaces\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CoffeePalaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_en')
                    ->required(),
                TextInput::make('name_ar')
                    ->required(),
                Textarea::make('location_link')
                    ->columnSpanFull(),
                Select::make('coffee_id')
                    ->relationship('coffee', 'id')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
            ]);
    }
}
