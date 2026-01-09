<?php

namespace App\Filament\Resources\CoffeePalaces;

use App\Filament\Resources\CoffeePalaces\Pages\CreateCoffeePalace;
use App\Filament\Resources\CoffeePalaces\Pages\EditCoffeePalace;
use App\Filament\Resources\CoffeePalaces\Pages\ListCoffeePalaces;
use App\Filament\Resources\CoffeePalaces\Schemas\CoffeePalaceForm;
use App\Filament\Resources\CoffeePalaces\Tables\CoffeePalacesTable;
use App\Models\CoffeePalace;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CoffeePalaceResource extends Resource
{
    protected static ?string $model = CoffeePalace::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?string $navigationLabel = 'Coffee Palaces';

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return CoffeePalaceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CoffeePalacesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCoffeePalaces::route('/'),
            'create' => CreateCoffeePalace::route('/create'),
            'edit' => EditCoffeePalace::route('/{record}/edit'),
        ];
    }
}
