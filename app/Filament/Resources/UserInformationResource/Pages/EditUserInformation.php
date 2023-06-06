<?php

namespace App\Filament\Resources\UserInformationResource\Pages;

use App\Filament\Resources\UserInformationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserInformation extends EditRecord
{
    protected static string $resource = UserInformationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
