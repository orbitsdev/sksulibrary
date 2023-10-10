<?php

namespace App\Filament\Resources\IdDataResource\Pages;

use App\Filament\Resources\IdDataResource;
use App\Models\IdData;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIdData extends ManageRecords
{
    protected static string $resource = IdDataResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
