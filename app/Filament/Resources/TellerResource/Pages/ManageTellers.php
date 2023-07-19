<?php

namespace App\Filament\Resources\TellerResource\Pages;

use App\Filament\Resources\TellerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTellers extends ManageRecords
{
    protected static string $resource = TellerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
