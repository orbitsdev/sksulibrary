<?php

namespace App\Filament\Resources\CardResource\Pages;

use App\Filament\Resources\CardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCards extends ManageRecords
{
    protected static string $resource = CardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
