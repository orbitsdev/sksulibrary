<?php

namespace App\Filament\Resources\DayRecordResource\Pages;

use App\Models\DayRecord;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\DayRecordResource;
use App\Models\DayLogin;
use App\Models\Student;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
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

    protected function getTableColumns(): array 

    {

        return [
          TextColumn::make('student')->label('Student Name')->formatStateUsing(function($record){
            return strtoupper($record->student->first_name . ' ' . $record->student->last_name);
          }),
          TextColumn::make('student.id_number')->label('ID Number')->searchable(),
          TextColumn::make('student.course.name')->label('Course')->searchable(),
          TextColumn::make('student.campus.name')->label('Campus')->searchable(),
          TextColumn::make('created_at')->label('Time in')->date('g:i A '),
          TextColumn::make('logout.updated_at')->label('Time out')->date('g:i A  '),
        ];

    }
    protected function getTableQuery(): Builder 
    {
        return DayLogin::query()->where('day_record_id' , $this->dayRecord);
    } 

}   
