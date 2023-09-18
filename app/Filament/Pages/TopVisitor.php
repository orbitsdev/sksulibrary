<?php

namespace App\Filament\Pages;

use Closure;
use Filament\Forms;
use App\Models\Course;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;

class TopVisitor extends Page implements Forms\Contracts\HasForms 
{

    use Forms\Concerns\InteractsWithForms; 
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.top-visitor';

    public $students = [];
    public $month_selected;
    public $course_selected;
    public $year_selected;
    public $campus_selected;

    public function mount(){
        $this->students = Student::whereHas('logins', function ($query) {
            $query->whereMonth('created_at', now()->month); // Filter for the current month
        })
        ->withCount(['logins' => function ($query) {
            $query->whereMonth('created_at', now()->month); // Filter for the current month
        }])
        ->orderByDesc('logins_count')
        ->take(10) // Get the top 10 students
        ->get();
        
        
    }
    protected function getFormSchema(): array 
    {
        return [
            Grid::make(6)
            ->schema([
          
             
               
                Select::make('course_selected')
                    ->options(collect(Course::query() // Filter courses based on the selected campus.
                    ->pluck('name', 'id'))
                    ->prepend('All', 'all')
                    ->toArray())
                    ->columnSpan(2)
                    ->default(1) // Set the default value to 1
                    ->searchable()
                    ->label('Course')
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {

                     
                        
                    }),
                    
                   
            

            ]),
        
        ];
    } 
}
