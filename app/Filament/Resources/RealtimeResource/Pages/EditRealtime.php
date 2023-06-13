<?php

namespace App\Filament\Resources\RealtimeResource\Pages;

use App\Filament\Resources\RealtimeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRealtime extends EditRecord
{
    protected static string $resource = RealtimeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
