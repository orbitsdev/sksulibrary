<?php

namespace App\Filament\Resources\DayRecordResource\Pages;

use App\Filament\Resources\DayRecordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDayRecord extends EditRecord
{
    protected static string $resource = DayRecordResource::class;
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
