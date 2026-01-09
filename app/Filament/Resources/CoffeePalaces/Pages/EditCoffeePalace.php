<?php

namespace App\Filament\Resources\CoffeePalaces\Pages;

use App\Filament\Resources\CoffeePalaces\CoffeePalaceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCoffeePalace extends EditRecord
{
    protected static string $resource = CoffeePalaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
