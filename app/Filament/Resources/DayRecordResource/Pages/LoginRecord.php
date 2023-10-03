<?php

namespace App\Filament\Resources\DayRecordResource\Pages;

use Filament\Tables;
use App\Models\Student;
use App\Models\DayLogin;
use App\Models\DayRecord;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\DayRecordResource;

class LoginRecord extends Page implements Tables\Contracts\HasTable
{

    use Tables\Concerns\InteractsWithTable; 


    



 
    protected static string $resource = DayRecordResource::class;

    protected static string $view = 'filament.resources.day-record-resource.pages.login-record';


    protected static ?string $modelLabel = 'cliente';
    
    public $dayRecord;
    public $dayData;
    public function mount($id){
      $this->dayRecord = $id;
      $this->dayData = DayRecord::find($id);
    
    }
    protected function getTableQuery(): Builder 
    {
        return DayLogin::query()->latest()->where('day_record_id' , $this->dayRecord);
    } 

    

    protected function getTableActions(): array

    {

        return [
          Tables\Actions\ActionGroup::make([

            Tables\Actions\Action::make('View Profile')->icon('heroicon-o-user')->button()->url(fn ($record): string =>  StudentResource::getUrl('details', $record->student_id)),
            DeleteAction::make(),
            // ViewAction::make('View Details')
            // ->button()
            // ->icon('heroicon-o-user')
            // ->label('View Profile')
            // ->action(fn ($record) =>$record)
            // ->modalHeading('Student Details')
            // ->modalContent(fn($record)=>  view('components.student-view', ['record'=> $record])),
            
            
        ]),
        ];

    }

    protected function getTableBulkActions(): array
    {
        return [ 
            Tables\Actions\BulkAction::make('delete')
                ->label('Delete selected')
                ->color('danger')
                ->action(function (Collection $records): void {
                    $records->each->delete();
                })
                ->requiresConfirmation(),
        ]; 
    } 

    protected function getTableColumns(): array 

    {

        return [
          TextColumn::make('student')->label('Student Name')->formatStateUsing(function($record){
            return $record->student->first_name . ' ' . $record->student->last_name;
          }),
          TextColumn::make('student.id_number')->label('ID Number')->searchable(),
          TextColumn::make('student.course.name')->label('Course')->searchable(),
          TextColumn::make('student.campus.name')->label('Campus')->searchable(),
          TextColumn::make('created_at')->label('Time in')->date('g:i A ')->color('success'),
          TextColumn::make('logout.updated_at')->label('Time out')->formatStateUsing(function($record){
              if($record->logout->status == 'Logged out'){
                return $record->logout->updated_at->format('g:i A ');
              }

              if($record->logout->status == 'Did Not Logout'){
                return 'No Logout';
              }
              return '- Currently Inside  -';
          })->color('danger'),
        ];

    }
   

}   
