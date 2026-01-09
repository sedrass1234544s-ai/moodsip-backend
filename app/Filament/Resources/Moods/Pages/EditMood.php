<?php

namespace App\Filament\Resources\Moods\Pages;

use App\Filament\Resources\Moods\MoodResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMood extends EditRecord
{
    protected static string $resource = MoodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
