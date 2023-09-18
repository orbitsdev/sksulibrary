<?php

namespace App\Filament\Resources\CampusResource\Pages;

use Filament\Pages\Actions;
use App\Exports\CampusExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\CampusResource;
use App\Imports\CampusForUpdateImport;
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
            ])
            ->modalSubheading("Note that an existing name won't be created.")            
            ,
            Actions\Action::make('Import Update ')->button()->action(function (array $data): void {

                $file  = Storage::disk('public')->path($data['file']);
               
                Excel::import(new CampusForUpdateImport, $file);

                if (Storage::disk('public')->exists($data['file'])) {

                    Storage::disk('public')->delete($data['file']);
                }
            })->icon('heroicon-o-save')->form([
                FileUpload::make('file')->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/csv', 'text/csv', 'text/plain'])->disk('public')->directory('imports')
            ])
            ->modalSubheading("When updating campuses, make sure data is accurate. Double-check names in the database and be mindful of case sensitivity. Changes to non-existent data won't be recorded. If you have questions or need help, reach out to us; we're here for you!")            
            ->label('Import to Updates'),

            Actions\Action::make('Download Reference')->button()->action(function(){        
                return Excel::download(new CampusExport, 'campuses.xlsx');
            })->icon('heroicon-o-document-download')->requiresConfirmation()->modalHeading('Export to Excel')
            ->modalSubheading('Donwload Excel as Report or Reference. . Note that an existing name won\'t be created.')
            ->modalButton('Yes'),
            Actions\CreateAction::make(),
        ];
    }
}
