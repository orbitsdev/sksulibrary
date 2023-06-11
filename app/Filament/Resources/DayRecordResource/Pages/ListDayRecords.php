<?php

namespace App\Filament\Resources\DayRecordResource\Pages;

use App\Filament\Resources\DayRecordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDayRecords extends ListRecords
{
    protected static string $resource = DayRecordResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
