<?php

namespace App\Filament\Resources\IndividualResource\Pages;

use App\Filament\Resources\IndividualResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndividual extends CreateRecord
{
    protected static string $resource = IndividualResource::class;


    protected function getRedirectUrl(): string
    {
        return  $this->getResource()::getUrl('index');
    }
}
