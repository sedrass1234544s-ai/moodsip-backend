<?php

namespace App\Filament\Resources\Coffees\Pages;

use App\Filament\Resources\Coffees\CoffeeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCoffee extends EditRecord
{
    protected static string $resource = CoffeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
