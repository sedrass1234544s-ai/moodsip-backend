<?php

namespace App\Filament\Resources\Moods;

use App\Filament\Resources\Moods\Pages\CreateMood;
use App\Filament\Resources\Moods\Pages\EditMood;
use App\Filament\Resources\Moods\Pages\ListMoods;
use App\Filament\Resources\Moods\Schemas\MoodForm;
use App\Filament\Resources\Moods\Tables\MoodsTable;
use App\Models\Mood;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MoodResource extends Resource
{
    protected static ?string $model = Mood::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFaceSmile;

    protected static ?string $navigationLabel = 'Moods';

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return MoodForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MoodsTable::configure($table);
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
            'index' => ListMoods::route('/'),
            'create' => CreateMood::route('/create'),
            'edit' => EditMood::route('/{record}/edit'),
        ];
    }
}
