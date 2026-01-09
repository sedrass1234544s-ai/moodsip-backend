<?php

namespace App\Filament\Resources\Answers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('answer_en')
                    ->required(),
                TextInput::make('answer_ar')
                    ->required(),
                Select::make('question_id')
                    ->relationship('question', 'id')
                    ->required(),
            ]);
    }
}
