<?php

namespace App\Filament\Resources\Moods\Pages;

use App\Filament\Resources\Moods\MoodResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMood extends CreateRecord
{
    protected static string $resource = MoodResource::class;
}
