<?php

namespace App\Filament\Pages;

use Closure;
use Filament\Forms;
use App\Models\Course;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;

class TopVisitor extends Page implements Forms\Contracts\HasForms 
{

    use Forms\Concerns\InteractsWithForms; 
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.top-visitor';

    public $students = [];
    public $month;
    public $to;
    public $course_selected;
    public $year_selected;
    public $campus_selected;

    public $courses = [];
    public $campuses = [];

    public function mount(){


        $this->month = now()->format('Y-m');
        $this->students = Student::whereHas('logins', function ($query) {
            $query->whereYear('created_at', now()->year)
                  ->whereMonth('created_at', now()->month); // Filter for the current month and year
        })
        ->withCount(['logins' => function ($query) {
            $query->whereYear('created_at', now()->year)
                  ->whereMonth('created_at', now()->month); // Filter for the current month and year
        }])
        ->orderByDesc('logins_count')
        ->take(10) // Get the top 10 students
        ->get();
        
        
        $this->courses = Course::all();

        
        
    }

    public function updatedmonth(){

       // This line is fine for getting the current month and year
    
       $dateInfo = date_parse_from_format('Y-m', $this->month);

       $this->students = Student::whereHas('logins', function ($query) use ($dateInfo) {
           $query->whereYear('created_at', $dateInfo['year'])
                 ->whereMonth('created_at', $dateInfo['month']); // Filter for the specified month and year
       })
       ->withCount(['logins' => function ($query) use ($dateInfo) {
           $query->whereYear('created_at', $dateInfo['year'])
                 ->whereMonth('created_at', $dateInfo['month']); // Filter for the specified month and year
       }])
       ->orderByDesc('logins_count')
       ->take(10) // Get the top 10 students
       ->get();
      
       
       
      
    }
    public function updatedCourseSelected(){

      
        $dateInfo = date_parse_from_format('Y-m', $this->month);

       $this->students = Student::whereHas('logins', function ($query) use ($dateInfo) {
           $query->whereYear('created_at', $dateInfo['year'])
                 ->whereMonth('created_at', $dateInfo['month']); // Filter for the specified month and year
       })
       ->when($this->course_selected != 'all',   function ($query){
        $query->whereHas('course', function($query){
            $query->where('id', $this->course_selected);
        });
       })
       ->withCount(['logins' => function ($query) use ($dateInfo) {
           $query->whereYear('created_at', $dateInfo['year'])
                 ->whereMonth('created_at', $dateInfo['month']); // Filter for the specified month and year
       }])
       ->orderByDesc('logins_count')
       ->take(10) // Get the top 10 students
       ->get();
      
       
       
      
    }

    public function fileterQuery(){

    }
    protected function getFormSchema(): array 
    {
        return [
            Grid::make(6)
            ->schema([
          
          
               
                // Select::make('course_selected')
                //     ->options(collect(Course::query() // Filter courses based on the selected campus.
                //     ->pluck('name', 'id'))
                //     ->prepend('All', 'all')
                //     ->toArray())
                //     ->columnSpan(2)
                //     ->default(1) // Set the default value to 1
                //     ->searchable()
                //     ->label('Course')
                //     ->reactive()
                //     ->afterStateUpdated(function (Closure $set, $state) {
                //         $this->students = Student::whereHas('logins', function ($query) {
                //             $query->whereMonth('created_at', now()->month); // Filter for the current month
                //         })
                //         ->withCount(['logins' => function ($query) {
                //             $query->whereMonth('created_at', now()->month); // Filter for the current month
                //         }])
                //         ->when($state != 'all', function($query) use ($state){
                //             $query->whereHas('course', function($query) use($state){
                //                 $query->where('id', $state);
                //             });
                //         })

                //         ->when($this->from || $this->to, function ($query) {
                         
                //             $query->whereHas('login', function ($query) {
                //                 if ($this->from && $this->to) {
                //                     $from = $this->from . ' 00:00:00'; // Start of selected day
                //                     $to = $this->to . ' 23:59:59';    
                //                     $query->whereBetween('created_at', [$from, $to]);
                                  
                //                 } elseif ($this->from) {
                                    
                //                     $query->where('created_at', '>=', $this->from);
                                    
                //                 } elseif ($this->to) {
                //                     $query->where('created_at', '<=', $this->to);
                //                 }
                //             });
                //         })
                //         ->orderByDesc('logins_count')
                //         ->take(10) // Get the top 10 students
                //         ->get();
                     
                        
                //     }),

                //     DateTimePicker::make('from')->label('From')
                //     ->reactive()
                //     ->afterStateUpdated(function (Closure $set, $state) {
                //         $this->students = Student::whereHas('logins', function ($query) {
                //             $query->whereMonth('created_at', now()->month); // Filter for the current month
                //         })
                //         ->withCount(['logins' => function ($query) {
                //             $query->whereMonth('created_at', now()->month); // Filter for the current month
                //         }])
                //         ->when($state != 'all', function($query) use ($state){
                //             $query->whereHas('course', function($query) use($state){
                //                 $query->where('id', $state);
                //             });
                //         })

                //         ->when($state || $this->to, function ($query)  use ($state){
                         
                //             $query->whereHas('logins', function ($query) use($state) {
                //                 if ($state && $this->to) {
                //                     $from = $state . ' 00:00:00'; // Start of selected day
                //                     $to = $this->to . ' 23:59:59';    
                //                     $query->whereBetween('created_at', [$from, $to]);
                                  
                //                 } elseif ($state) {
                                    
                //                     $query->where('created_at', '>=', $state);
                                    
                //                 } elseif ($this->to) {
                //                     $query->where('created_at', '<=', $this->to);
                //                 }
                //             });
                //         });}

                    
                //     ),
                //     DateTimePicker::make('to')->label('To')->reactive(),
                    
                   
            

            ]),
        
        ];
    } 
}
