<?php

namespace App\Filament\Resources\GroomingBatches;

use App\Filament\Resources\GroomingBatches\Pages\CreateGroomingBatch;
use App\Filament\Resources\GroomingBatches\Pages\EditGroomingBatch;
use App\Filament\Resources\GroomingBatches\Pages\ListGroomingBatches;
use App\Filament\Resources\GroomingBatches\Schemas\GroomingBatchForm;
use App\Filament\Resources\GroomingBatches\Tables\GroomingBatchesTable;
use App\Models\GroomingBatch;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroomingBatchResource extends Resource
{
    protected static ?string $model = GroomingBatch::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::TableCells;

    protected static ?string $recordTitleAttribute = 'title'; // Note: Usually better to map this to a DB column like 'title' or 'name' rather than 'GroomingBatch'

    public static function form(Schema $schema): Schema
    {
        return GroomingBatchForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GroomingBatchesTable::configure($table);
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
            'index' => ListGroomingBatches::route('/'),
            'create' => CreateGroomingBatch::route('/create'),
            'edit' => EditGroomingBatch::route('/{record}/edit'),
        ];
    }
}