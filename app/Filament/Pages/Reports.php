<?php

namespace App\Filament\Pages;

use Closure;

use Filament\Forms;
use App\Models\Test;
use App\Models\User;
use Filament\Tables;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use App\Models\DayLogin;
use Filament\Pages\Page;
use App\Models\DayRecord;
use App\Exports\OverAllExport;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Grid;
use Illuminate\Contracts\View\View;
use Filament\Support\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;

class Reports extends Page implements Tables\Contracts\HasTable
{

    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static string $view = 'filament.pages.reports';



    public $search;
    public $logins = [];
    public $daySelected;
    public $dayData;
    public $courseSelected;
    public $campusSelected;
    public $yearSelected;
    public $selectedPeriod;
    public $selectedStatus;
    public $reportType;
    public $hideInputs;




    public function exportToExcel(){

        $filename = 'DAILY-RECORD-' . optional(Dayrecord::find($this->daySelected))->created_at->format('Y-m-d') ?? now()->format('Y-m-d');

        return Excel::download(new OverAllExport($this->logins), $filename.'.xlsx');
    }

    public function mount(): void {

     $this->form->fill();
       $this->reportType = 'library';
       $this->yearSelected = 'all';
       $this->selectedPeriod = 'all';
       $this->selectedStatus = 'all';
       $this->courseSelected = 'all';

       
        $day = DayRecord::orderBy('created_at', 'desc')->first();
         if(!empty($day)){
            $this->daySelected = $day->id;
            $this->dayData = DayRecord::where('id', $day)->first();
            $this->logins = DayLogin::latest()->where('day_record_id', $day->id)->whereHas('logout', function ($query) {
                $query->whereIn('status', ['Logged out', 'Did Not Logout']);
            })->get();
            
         }
         $this->dayData = DayRecord::latest()->first();
         $this->logins = DayLogin::latest()->get();

    }
    
    public function print()
    {
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


            Grid::make(6)
                ->schema([
              
                 
                   
                    Select::make('daySelected')
                        ->options(DayRecord::orderBy('created_at', 'desc')->pluck('created_at', 'id')->map(function ($date) {
                            return $date->format('F d,  Y - l ');
                        }))
                        ->columnSpan(2)
                        ->searchable()
                        ->label('Date')
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) {

                            $this->dayData = DayRecord::where('id', $state)->first();
                            $data = DayLogin::orderBy('created_at', 'desc')->where('day_record_id', $state)->whereHas('logout')->get();
                            $this->logins = $data;
                            
                        }),
                        
                        Select::make('courseSelected')
                        ->options(collect(Course::query() // Filter courses based on the selected campus.
                        ->pluck('name', 'id'))
                        ->prepend('All', 'all')
                        ->toArray())
                        ->searchable()
                        ->columnSpan(2)
                        ->label('Course Name')
                        ->reactive()
                        ->disablePlaceholderSelection()
                        ->afterStateUpdated(function (Closure $get, Closure $set, $state) {
                            
                            // Your existing code here, with modifications for filtering courses based on the selected campus.
                            if (!empty($get('daySelected'))) {
                                $data = DayLogin::orderBy('created_at', 'desc')
                                    ->where('day_record_id', $get('daySelected'))
                                    ->when($state != 'all', function ($query) use ($state) {
                                        $query->whereHas('student.course', function ($query) use ($state) {
                                            $query->where('id', (int)$state);
                                        });
                                    })
                                
                                    ->get();
                              
                                $this->logins = $data;
                            }
                        }),
                    
                    Select::make('yearSelected')->options([
                        'all' => 'All',
                        '1st Year' => '1st Year',
                        '2nd Year' => '2nd Year',
                        '3rd Year' => '3rd Year',
                        '4th Year' => '4th Year',
                        // '5th Year' => '5th Year',
                    ])->columnSpan(2)->label('Student year')->reactive()->afterStateUpdated(function (Closure $get, Closure $set, $state) {



                        if (!empty($get('daySelected'))) {
                            $this->logins = DayLogin::orderBy('created_at', 'desc')
                                ->where('day_record_id', $get('daySelected'))
                                ->when($get('courseSelected') != 'all', function ($query) use ($get) {
                                    $query->whereHas('student.course', function ($query) use ($get) {
                                        $query->where('id', $get('courseSelected'));
                                    });
                                })
                                ->when($state != 'all', function ($query) use ($state) {
                                    $query->whereHas('student', function ($query) use ($state) {
                                        $query->where('year', $state);
                                    });
                                })
                                ->when($get('selectedStatus') != 'all', function ($query) use ($get) {
                                    $query->whereHas('logout', function ($query) use ($get) {
                                        $query->where('status', $get('selectedStatus'));
                                    });
                                })
                                ->when($get('selectedPeriod') != 'all', function ($query) use ($get) {
                                    if ($get('selectedPeriod') == 'am') {
                                        $query->whereTime('created_at', '<', '12:00:00');
                                    }
                                    if ($get('selectedPeriod') == 'pm') {
                                        $query->whereTime('created_at', '>=', '12:00:00');
                                    }
                                })
                                ->with(['student']) // Make sure to eager load the student relationship
                                ->get();
                        
                          
                       
                        }
                        
                    })->default('all')->disablePlaceholderSelection(),

                    Select::make('selectedStatus')->options([
                        'all'=> 'All',
                        // 'Logged out'=> 'Logged out',
                        // 'Did Not Logout'=> 'Did Not Logout',
                        'Not Logout'=> 'Currently Inside',
                    ])->columnSpan(2)->label('Record status')->reactive()->default('all')
                    ->disablePlaceholderSelection()
                    ->afterStateUpdated(function (Closure $get, Closure $set, $state) {


                    
                        if(!empty($get('daySelected'))){
                               
                            $data = DayLogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
                              
                            ->when($get('courseSelected') != 'all',  function($query) use ($get){
                                $query->whereHas('student.course',  function ($query) use ($get) {
                                    $query->where('id', $get('courseSelected'));
                                });
                            })
                          
                            ->when($get('yearSelected') != 'all', function($query) use ($get){
                               
                                $query->whereHas('student', function($query) use($get){
                                    $query->where('year', $get('yearSelected'));
                                });
                              
                            })

                            ->when($get('courseSelected') != 'all', function ($query) use ($get) {
                                $query->whereHas('student.course', function ($query) use ($get) {
                                    $query->where('id', (int)$get('courseSelected'));
                                });
                            })
                            ->when($state != 'all', function ($query) use ($state) {
                               
                                $query->whereHas('logout', function ($query) use ($state) {
                                    $query->where('status', $state);
                                });
                            })
                            ->when($get('selectedPeriod') != 'all', function ($query) use ($get) {
                                 
                                if($get('selectedPeriod') == 'am'){
                                        $query->whereTime('created_at', '<', '12:00:00');
                                }
                              if($get('selectedPeriod') == 'pm'){
                                        $query->whereTime('created_at', '>=', '12:00:00');

                                }

                            })
                            ->get();
                            
                            $this->logins = $data;
                        }

                      
                        
                        
                    }),

                    Select::make('selectedPeriod')->options([
                        'all'=> 'All',
                        'am'=> 'AM',
                        'pm'=> 'PM',
                    ])->label('Time period')->reactive()->default('all')->disablePlaceholderSelection()
                    ->afterStateUpdated(function (Closure $get, Closure $set, $state) {


                    
                        if(!empty($get('daySelected'))){
                               
                            $data = DayLogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
                              
                            ->when($get('courseSelected') != 'all',  function($query) use ($get){
                                $query->whereHas('student.course',  function ($query) use ($get) {
                                    $query->where('id', $get('courseSelected'));
                                });
                            })
                            ->when($get('courseSelected') != 'all', function ($query) use ($get) {
                                $query->whereHas('student.course', function ($query) use ($get) {
                                    $query->where('id', (int)$get('courseSelected'));
                                });
                            })
                          
                            ->when($get('yearSelected') != 'all', function($query) use ($get){
                               
                                $query->whereHas('student', function($query) use($get){
                                    $query->where('year', $get('yearSelected'));
                                });
                              
                            })
                            ->when($get('selectedStatus') != 'all', function ($query) use ($get) {
                               
                                $query->whereHas('logout', function ($query) use ($get) {
                                    $query->where('status', $get('selectedStatus'));
                                });
                            })
                            ->when($state != 'all', function ($query) use ($state) {
                                 
                                if($state == 'am'){
                                        $query->whereTime('created_at', '<', '12:00:00');
                                }
                              if($state == 'pm'){
                                        $query->whereTime('created_at', '>=', '12:00:00');

                                }

                            })
                            ->get();
                            
                            $this->logins = $data;
                        }
                        
                
                    }),

                ]),

        ];
    }
}
