<?php

namespace App\Filament\Resources\IdDataResource\Pages;

use App\Models\IdData;
use Filament\Pages\Actions;
use Filament\Tables\Actions\Position;
use App\Filament\Resources\IdDataResource;
use Filament\Resources\Pages\ManageRecords;

class ManageIdData extends ManageRecords
{
    protected static string $resource = IdDataResource::class;
    protected function getTableActionsPosition(): ?string
{
    return Position::BeforeCells;
}

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
