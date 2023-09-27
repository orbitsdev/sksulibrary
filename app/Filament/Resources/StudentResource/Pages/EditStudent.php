<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Student;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;

    public $created_user;
    protected function mutateFormDataBeforeSave(array $data): array
    {

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
