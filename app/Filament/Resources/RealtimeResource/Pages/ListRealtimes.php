<?php

namespace App\Filament\Resources\RealtimeResource\Pages;

use App\Filament\Resources\RealtimeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRealtimes extends ListRecords
{
    protected static string $resource = RealtimeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
