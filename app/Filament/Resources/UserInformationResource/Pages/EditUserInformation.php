<?php

namespace App\Filament\Resources\UserInformationResource\Pages;

use App\Filament\Resources\UserInformationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserInformation extends EditRecord
{
    protected static string $resource = UserInformationResource::class;
    protected function getRedirectUrl(): string
    {
        return  $this->getResource()::getUrl('index');
    }
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
