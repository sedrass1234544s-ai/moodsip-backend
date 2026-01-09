<?php

namespace App\Filament\Resources\CoffeePalaces\Pages;

use App\Filament\Resources\CoffeePalaces\CoffeePalaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCoffeePalaces extends ListRecords
{
    protected static string $resource = CoffeePalaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
