<?php

namespace App\Filament\Resources\Coffees\Pages;

use App\Filament\Resources\Coffees\CoffeeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCoffees extends ListRecords
{
    protected static string $resource = CoffeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
