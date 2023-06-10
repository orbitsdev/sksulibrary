<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\DayLogin;
use App\Models\DayRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Filament\Widgets\TableWidget as BaseWidget;



class TodayRecord extends BaseWidget
{

    protected int | string | array $columnSpan = '2';



   

    protected static ?int $sort = 1;


    
    protected function getTablePollingInterval(): ?string
{
    return '1s';
}

    protected function getTableQuery(): Builder
    {   

        return DayLogin::query()->whereHas('logout', function($query){
            $query->where('status','Not Logout');
        })->latest();

       


    }

    protected function paginateTableQuery(Builder $query): Paginator
{
    return $query->simplePaginate($this->getTableRecordsPerPage() == -1 ? $query->count() : $this->getTableRecordsPerPage());
}

    protected function getTableColumns(): array
    {
        return [
         
            Tables\Columns\TextColumn::make('updated_at')->label('Time in') ->formatStateUsing(function ($record){ 
                return $record->updated_at->diffForHumans();
            
            }),

            Tables\Columns\TextColumn::make('student.first_name')->label('Student Name') ->formatStateUsing(function ($record){ 
                return strtoupper( $record->student->first_name . ' ' . $record->student->last_name);
            }),
            Tables\Columns\TextColumn::make('student.year')->label('Year '),
            Tables\Columns\TextColumn::make('student.course.name')->label('Course'),
            
            
        ];
    }
}
