<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\DayLogin;


class LoggedOut extends BaseWidget
{
    protected static ?int $sort = 2;
  


    protected function getTablePollingInterval(): ?string
{
    return '1s';
}
    protected function getTableQuery(): Builder
    {
        return DayLogin::query()->whereHas('logout', function($query){
            $query->where('status','Logged out');
        })->latest();
    }

    protected function getTableColumns(): array
    {
        return [
        
            Tables\Columns\TextColumn::make('updated_at')->label('Time in') ->formatStateUsing(function ($record){ 
                return $record->logout->created_at->diffForHumans();
            
            }),

            Tables\Columns\TextColumn::make('student.first_name')->label('Student Name') ->formatStateUsing(function ($record){ 
                return strtoupper( $record->student->first_name . ' ' . $record->student->last_name);
            }),
            Tables\Columns\TextColumn::make('student.year')->label('Year '),
            Tables\Columns\TextColumn::make('student.course.name')->label('Course'),
        ];
    }
}
