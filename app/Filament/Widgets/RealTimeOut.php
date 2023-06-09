<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\DayLogin;
use App\Models\DayRecord;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class RealTimeOut extends BaseWidget
{
    protected static ?int $sort = 2;    

    protected function getTableRecordsPerPageSelectOptions(): array 
    {
        return [5];
    } 
  
    protected function getTableQueryStringIdentifier(): string
    {
        return 'users';
    }

    protected function getTablePollingInterval(): ?string
{
    return '1s';
}
    protected function getTableQuery(): Builder
    {

    
        $latestDay = DayRecord::latest()->first();
        if( $latestDay){
            
            return DayLogin::query()->where('day_record_id', $latestDay->id)->whereHas('logout', function($query){
                $query->where('status','Logged out');
            })->latest();
        }
        return DayLogin::query()->whereHas('logout', function($query){
            $query->where('status','Logged out');
        })->latest();
    }

    protected function getTableColumns(): array
    {
        return [
        
         
            Tables\Columns\TextColumn::make('student.first_name')->label('Name') ->formatStateUsing(function ($record){ 
                return $record->student->first_name . ' ' . $record->student->last_name;
            })->searchable(),
            // Tables\Columns\TextColumn::make('student.course.name')->label('Course'),
            Tables\Columns\TextColumn::make('student.year')->label('Year'),
            Tables\Columns\TextColumn::make('logout.updated_at')->label('Time out')->since()->color('danger'),
            
        ];
    }
}
