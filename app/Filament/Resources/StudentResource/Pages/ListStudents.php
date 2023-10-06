<?php

namespace App\Filament\Resources\StudentResource\Pages;

use Filament\Pages\Actions;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Filament\Pages\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;

use Filament\Tables\Actions\Position;
use App\Imports\StudentForUpdateImport;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\StudentResource;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getActions(): array
    {
        return [
            
            Actions\Action::make('generate-id-layout')->button()->action(function (array $data): void {

            })->label('Generate Printable ID '),
            Actions\Action::make('Import')->button()->action(function (array $data): void {

                $file  = Storage::disk('public')->path($data['file']);
               
                Excel::import(new StudentImport, $file);

                if (Storage::disk('public')->exists($data['file'])) {

                    Storage::disk('public')->delete($data['file']);
                }
            })->icon('heroicon-o-save')->form([
                FileUpload::make('file')->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/csv', 'text/csv', 'text/plain'])->disk('public')->directory('imports')
            ])
            ->modalSubheading("Please ensure data accuracy by verifying that member names exist in the database, including campus, department, course, and section names. Remember that names are case-sensitive, so double-check capitalization and spelling. Attempting to assign names that do not exist in the database won't reflect or save in the import!")
            ,
            // Actions\Action::make('ImportUpdate')->button()->action(function (array $data): void {

            //     $file  = Storage::disk('public')->path($data['file']);
               
            //     Excel::import(new StudentForUpdateImport, $file);

            //     if (Storage::disk('public')->exists($data['file'])) {

            //         Storage::disk('public')->delete($data['file']);
            //     }
            // })->icon('heroicon-o-save')->form([
            //     FileUpload::make('file')->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/csv', 'text/csv', 'text/plain'])->disk('public')->directory('imports')
            // ])
            // ->modalSubheading("When updating accounts, ensure data accuracy. Confirm member names exist in the database (e.g., campus, department, course, section). Remember, names are case-sensitive. Modifying non-existeng data won't reflect in the record. Questions or need assistance? Contact us; we're here to help!")            
            // ->label('Import to Updates')
            // ,
            Actions\Action::make('Export')->button()->action(function(array $data) {
              
                
                // return Excel::download(new UserExport, 'invoices.xlsx');
                return Excel::download(new StudentExport, 'students.xlsx');

            })->icon('heroicon-o-document-download')->requiresConfirmation()->modalHeading('Export to Excel')
            ->modalSubheading('Donwload Excel as Report or Reference')
            ->modalButton('Yes')
            ->label('Download Reference')
            ,
            
            Actions\CreateAction::make()->label('New Student'),
          
        ];
    }

    // protected function getTableActionsPosition(): ?string
    // {
    //     return Position::BeforeCells;
    // }
}
