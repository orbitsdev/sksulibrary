<?php

namespace App\Filament\Pages;

use Closure;

use Filament\Forms;
use App\Models\Test;
use App\Models\User;
use Filament\Tables;
use App\Models\Course;
use App\Models\Student;
use App\Models\DayLogin;
use Filament\Pages\Page;
use App\Models\DayRecord;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Grid;
use Illuminate\Contracts\View\View;
use Filament\Support\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;

class Reports extends Page implements Tables\Contracts\HasTable
{

    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static string $view = 'filament.pages.reports';
    

    public $report_type = 'all';
    public $day;
    public $selectId;
    public $logins =[];



    public function print(){
        $this->dispatchBrowserEvent('printTable', ['newName' => 'dasd']);
    }


    protected function getTableQuery(): Builder
    {
        return Test::query();
    }




    protected function getTableColumns(): array
    {
        return [
            // Tables\Columns\TextColumn::make('first_name')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('last_name')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('campus_id')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('course_id')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('student_id')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('created_at')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('updated_at')->searchable()->sortable(),
            // Tables\Columns\TextColumn::make('deleted_at')->searchable()->sortable(),
        ];
    }




    protected function getFormSchema(): array
    {
        return [


            Grid::make(12,)
                ->schema([
                    // Select::make('report_type')->options([
                    //     'all' => 'All',
                    //     'By Course' => 'By Course',
                    // ])->columnSpan(3)->default('draft')->searchable()->label('Type')->reactive(),
                    // Select::make('selectId')->options(DayRecord::pluck('created_at', 'id')->map(function ($date){
                       
                    //         return $date->format('l - d , F Y ');
                    // }))->columnSpan(6)->default(1)->searchable()->label('Date')->reactive()->afterStateUpdated(function (Closure  $set, $state) {
                        
                    //     $data = DayLogin::where('day_record_id', $state)->get();

                    //     $this->logins = $data;
                                
                        
                    // })->disablePlaceholderSelection(),

                    Select::make('selectId')
                    ->options(DayRecord::orderBy('created_at', 'desc')->pluck('created_at', 'id')->map(function ($date) {
                        return $date->format('l - d , F Y ');
                    }))
                    ->columnSpan(3)
                    ->default(1) // Set the default value to 1
                    ->searchable()
                    ->label('Select Date')
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {

                        
                        $data = DayLogin::orderBy('created_at', 'desc')->where('day_record_id', $state)->get();
                        $this->logins = $data;
                    })
                    ->disablePlaceholderSelection(),

                    
                    
                

                 
                ]),

        ];
    }
}
