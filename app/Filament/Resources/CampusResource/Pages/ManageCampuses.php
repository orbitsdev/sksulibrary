<?php

namespace App\Filament\Resources\CampusResource\Pages;

use Filament\Pages\Actions;
use App\Exports\CampusExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\CampusResource;
use App\Imports\CampusImport;
use Filament\Resources\Pages\ManageRecords;

class ManageCampuses extends ManageRecords
{
    protected static string $resource = CampusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Import ')->button()->action(function (array $data): void {

                $file  = Storage::disk('public')->path($data['file']);
               
                Excel::import(new CampusImport, $file);

                if (Storage::disk('public')->exists($data['file'])) {

                    Storage::disk('public')->delete($data['file']);
                }
            })->icon('heroicon-o-save')->form([
                FileUpload::make('file')->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/csv', 'text/csv', 'text/plain'])->disk('public')->directory('imports')
            ]),

            Actions\Action::make('Export')->button()->action(function(){        
                return Excel::download(new CampusExport, 'campuses.xlsx');
            })->icon('heroicon-o-document-download'),
            Actions\CreateAction::make(),
        ];
    }
}
