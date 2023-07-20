<?php

namespace App\Filament\Resources\QuequeResource\Pages;

use App\Filament\Resources\QuequeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageQueques extends ManageRecords
{
    protected static string $resource = QuequeResource::class;

    protected function getTablePollingInterval(): ?string
    {
        return '1s';
    }
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
