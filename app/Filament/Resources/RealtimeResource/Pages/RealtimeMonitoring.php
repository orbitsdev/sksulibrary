<?php

namespace App\Filament\Resources\RealtimeResource\Pages;
use Filament\Tables;
use App\Models\Student;
use App\Models\DayLogin;
use App\Models\DayRecord;
use Filament\Resources\Pages\Page;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource;
use App\Filament\Resources\RealtimeResource;

class RealtimeMonitoring extends Page implements Tables\Contracts\HasTable
{

    use Tables\Concerns\InteractsWithTable; 

    protected static string $resource = RealtimeResource::class;

    protected static string $view = 'filament.resources.realtime-resource.pages.realtime-monitoring';
   
   

    public $latestDay;
    public $latestRecord;



    public function mount(){
        
       $this->latestDay = DayRecord::latest()->first();
        $this->latestRecord = DayLogin::latest()->first();
    }


    protected function getTablePollingInterval(): ?string
    {
        return '1s';
    }

    protected function getTableQuery(): Builder 
    {
        return DayLogin::query()
        ->where('day_record_id', $this->latestDay->id)
        ->orderBy('created_at', 'desc')
        ->whereHas('logout', function($query){
            $query->where('status', '!=', 'Did Not Logout');
        })
        ->latest();
        // return DayLogin::query()->orderBy('created_at', 'desc')->whereHas('logout')->latest();
    } 

    protected function getTableColumns(): array
    {
        return [
        
            Tables\Columns\TextColumn::make('student.first_name')->label('Name')->formatStateUsing(function ($record){ 
                return $record->student->first_name . ' ' . $record->student->last_name;
            })->searchable(),
            Tables\Columns\TextColumn::make('student.course.name')->label('Course'),
            Tables\Columns\TextColumn::make('student.year')->label('Year'),
            Tables\Columns\TextColumn::make('updated_at')->label('Time in')->formatStateUsing(function($record){
              
                if($record->logout->status == 'Logged out'){
                    return 'Signed out';
                }

                return $record->updated_at->diffForHumans();
                // if($record->logout->status == 'Not Logout'){
                // }

            })->color('success'),
            Tables\Columns\TextColumn::make('logout.updated_at')->label('Time out')->formatStateUsing(function($record){

                if($record->logout->status == 'Logged out'){
                    return $record->logout->updated_at->diffForHumans();
                }else{
                    return '- Currently Inside -';
                }

            })->color('danger'),
            
            
        ];
    }

    protected function getTableActions(): array

    {

        return [
          Tables\Actions\ActionGroup::make([

            Tables\Actions\Action::make('View Profile')->icon('heroicon-o-user')->button()->url(fn ($record): string =>  StudentResource::getUrl('details', $record->student_id)),
            
            
        ]),
        ];

    }

    protected function getTableFilters(): array
{
    return [
        // SelectFilter::make('logout.status')
        // ->options([
        //     'Not Logout' => 'In',
        //     'Did Not Logout' => 'Out',
        // ])
    ];
}

}
