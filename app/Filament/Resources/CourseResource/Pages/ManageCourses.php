<?php

namespace App\Filament\Resources\CourseResource\Pages;

use Filament\Pages\Actions;
use App\Exports\CourseExport;
use App\Imports\CourseImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\CourseResource;
use App\Imports\CourseForUpdateImport;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Collection;

class ManageCourses extends ManageRecords
{
    protected static string $resource = CourseResource::class;
    

    protected function getActions(): array
    {
        return [


            Actions\Action::make('Import')->button()->action(function (array $data): void {

                $file  = Storage::disk('public')->path($data['file']);
               
                Excel::import(new CourseImport, $file);

                if (Storage::disk('public')->exists($data['file'])) {

                    Storage::disk('public')->delete($data['file']);
                }
            })->icon('heroicon-o-save')->form([
                FileUpload::make('file')->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/csv', 'text/csv', 'text/plain'])->disk('public')->directory('imports')
            ])
            ->modalSubheading("Please note that the course ID is used as the primary identifier. If the course ID exists, the data will be updated. If the ID is null or does not exist, the system will use the name as the basis and automatically create a new record. ")            

            ,

            // Actions\Action::make('Import To Update')->button()->action(function (array $data): void {

            //     $file  = Storage::disk('public')->path($data['file']);
               
            //     Excel::import(new CourseForUpdateImport, $file);

            //     if (Storage::disk('public')->exists($data['file'])) {

            //         Storage::disk('public')->delete($data['file']);
            //     }
            // })->icon('heroicon-o-save')->form([
            //     FileUpload::make('file')->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/csv', 'text/csv', 'text/plain'])->disk('public')->directory('imports')
            // ])->label('Import To Update'),

            Actions\Action::make('Export')->button()->action(function(array $data) {
              
                
                // return Excel::download(new UserExport, 'invoices.xlsx');
                return Excel::download(new CourseExport, 'courses.xlsx');

            })
            ->label('Download Reference')
            ->icon('heroicon-o-document-download')->requiresConfirmation()->modalHeading('Export to Excel')
            ->modalSubheading('Donwload Excel as Report or Reference. Existing name wont be created again')
            ->modalButton('Yes'),
            Actions\CreateAction::make()
            ->disableCreateAnother()
            ,
        ];
    }
}
