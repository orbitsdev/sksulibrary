<?php

namespace App\Filament\Resources\IndividualResource\Pages;

use App\Filament\Resources\IndividualResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndividuals extends ListRecords
{
    protected static string $resource = IndividualResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
