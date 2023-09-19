<?php

namespace App\Filament\Pages;

use App\Models\Campus;
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
    public $campus_selected;
    public $year_selected;
    public $courses = [];
    public $campuses = [];
    public function mount()
    {

        $this->month = now()->format('Y-m');
        $this->initializeStudents();
        $this->courses = Course::all();
        $this->campuses = Campus::all();
    }
    
    public function updatedMonth()
    {
        $this->initializeStudents();
    }
    
    public function updatedCampusSelected()
    {
     ; // Reset the month to the current month
        $this->initializeStudents();
        // Fetch and update available course options based on the selected campus
        $this->updateCourseOptions();
    }
    
    public function updatedCourseSelected()
    {
        $this->initializeStudents();
    }
    
    protected function initializeStudents()
    {   
       
        $dateInfo = date_parse_from_format('Y-m', $this->month);
    
        $query = Student::whereHas('logins', function ($query) use ($dateInfo) {
            $query->whereYear('created_at', $dateInfo['year'])
                ->whereMonth('created_at', $dateInfo['month']);
        })
        ->withCount(['logins' => function ($query) use ($dateInfo) {
            $query->whereYear('created_at', $dateInfo['year'])
                ->whereMonth('created_at', $dateInfo['month']);
        }])
        ->orderByDesc('logins_count')
        ->take(10);
    
        if ($this->course_selected && $this->course_selected !== 'all') {
            $query->whereHas('course', function ($query) {
                $query->where('id', $this->course_selected);
            });
        }
    
        if ($this->campus_selected && $this->campus_selected !== 'all') {
            $query->whereHas('campus', function ($query) {
                $query->where('id', $this->campus_selected);
            });
        }
    
        $this->students = $query->get();
    }
    
    protected function updateCourseOptions()
    {
        // Fetch and update available course options based on the selected campus
        if ($this->campus_selected && $this->campus_selected !== 'all') {
            $this->courses = Course::where('campus_id', $this->campus_selected)->get();
        } else {
            // If "All Campuses" or no campus is selected, show all courses
            $this->courses = Course::all();
        }
    
        // Reset the course selection to "all" when campus changes
        $this->course_selected = 'all';
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
