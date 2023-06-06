<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use App\Imports\UsersImport;
use App\Models\UserInformation;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Position;
use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;


    public $file;

    protected function getTableActionsPosition(): ?string
    {
        return Position::BeforeCells;
    }
    protected function getActions(): array
    {
        return [
            Actions\Action::make('Import')->button()->action(function(array $data) :void {

            $file  = Storage::disk('public')->path($data['file']);
            $collection  =  Excel::import(new UsersImport, $file);
             
            if(  Storage::disk('public')->exists($data['file']) ){
             
                Storage::disk('public')->delete($data['file']);
            }
         })->icon('heroicon-o-save')->form([
            FileUpload::make('file')->acceptedFileTypes(['application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/csv','text/csv','text/plain'])->disk('public')->directory('imports') ]),
            Actions\CreateAction::make(),
        ];
    }
}
