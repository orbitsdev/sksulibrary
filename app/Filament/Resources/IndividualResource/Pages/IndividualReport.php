<?php

namespace App\Filament\Resources\IndividualResource\Pages;

use Closure;
use Filament\Forms;
use App\Models\Course;
use App\Models\Student;
use App\Models\DayLogin;

use App\Models\DayRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Grid;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use App\Exports\IndividualReportExport;
use App\Filament\Resources\IndividualResource;


class IndividualReport extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms; 
    protected static string $resource = IndividualResource::class;

    protected static string $view = 'filament.resources.individual-resource.pages.individual-report';

    public $logins=[];
    public $dayData;
    public $student;
    public $courseSelected;
    public $yearSelected;
    public $selectedPeriod;
    public $selectedStatus;
    public $name;
    

    public $idNumber;

    
    
    public function exportToExcel(){
        
        if(!empty($this->student)){
            $filename = $this->student?->first_name.'-'.$this->student?->last_name.'-'.$this->dayData->created_at->format('F-d-Y').'-Report';  
            
        }else{
            
            $filename = 'individualreport';
        }
        return Excel::download(new IndividualReportExport($this->logins), $filename.'.xlsx');
    }

    public function print()
    {
        $this->dispatchBrowserEvent('printStudentRecord');
    }

public function mount(): void {
    $this->form->fill();
    $this->dayData = DayRecord::latest()->first();
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
                ->default(DayRecord::latest()->first()->id ?? null)
                ->searchable()
                ->label('Date')
                ->reactive()
                ->afterStateUpdated(function (Closure $get, Closure $set, $state) {

                    $this->dayData = DayRecord::where('id', $state)->first();
                    
                    $this->student = null;
                    // $this->courseSelected = null;
                    // $this->yearSelected = null;
                    // $this->selectedPeriod = null;
                    // $this->selectedStatus = null;
                    $this->logins = [];
                    $this->form->fill([
                        'name'=> '',
                        'selectedStatus'=> 'all',
                        'selectedPeriod'=> 'all',
                    ]);

                    // if($get('name')){
                    //     $this->student = Student::where('id', $state)->first();
                    //     dd($this->student);
                    //     // dd($state);
                        
                           
                    //         $this->logins = Daylogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
                    //         ->when($get('selectedStatus') != 'all', function ($query) use ($get) {
                    //             $query->whereHas('logout', function ($query) use ($get) {
                    //                 $query->where('status', $get('selectedStatus'));
                    //             });
                    //         })
                    //         ->where('student_id', $this->student->id)
                    //         ->get();
                        
                    // }

                   

                    // dd($this->dayData);
                    // $data = DayLogin::orderBy('created_at', 'desc')->where('day_record_id', $state)->whereHas('logout', function ($query) {
                    //     $query->whereIn('status', ['Logged out', 'Did Not Logout']);
                    // })->get();
                    // $this->logins = $data;
                    
                }),
                // Select::make('idNumber')
                // ->options(Student::pluck('id_number',  'id_number')->toArray())
                // ->columnSpan(2)
                // ->searchable()
                // ->label('Id Number')
                // ->reactive()
                // ->afterStateUpdated(function (Closure $get, Closure $set, $state) {
                    
                //     $this->student = Student::where('id_number', $state)->first();
                //     // dd($state);
                //     if(!empty($get('daySelected'))){
                       
                //         $this->logins = Daylogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
                //         ->when($get('selectedStatus') != 'all', function ($query) use ($get) {
                //             $query->whereHas('logout', function ($query) use ($get) {
                //                 $query->where('status', $get('selectedStatus'));
                //             });
                //         })
                //         ->where('student_id', $this->student->id)
                //         ->get();
                //     }
                  
                    
                // })->searchable(),
                Select::make('name')
                ->options(function (Closure $get, Closure $set, $state) {
                    return Student::when($get('courseSelected') != 'all' && !empty($get('courseSelected')), function ($query) use ($get) {
                        $query->whereHas('course', function ($query) use ($get) {
                            $query->where('id', $get('courseSelected'));
                        });
                    })->whereHas('logins')->select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), 'id')->pluck('full_name', 'id')->toArray();
                })
                
                ->columnSpan(2)
                ->searchable()
                ->label('Full name')
                ->reactive()
                ->afterStateUpdated(function (Closure $get, Closure $set, $state) {
                        
                    $this->student = Student::where('id', $state)->first();
                    // dd($this->student);

                    // dd($state);
                    if(!empty($get('daySelected'))){
                       
                        $this->logins = Daylogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
                        // ->when($get('selectedStatus') != 'all', function ($query) use ($get) {
                        //     $query->whereHas('logout', function ($query) use ($get) {
                        //         $query->where('status', $get('selectedStatus'));
                        //     });
                        // })

                        ->where('student_id', $this->student->id)
                        ->get();
                    }
                  
                    
                })->searchable(),
                // Select::make('student')
                // ->options(Student::pluck('first_name',  'id')->toArray())
                // ->columnSpan(2)
                // ->default(1) // Set the default value to 1
                // ->searchable()
                // ->label('Last Number')
                // ->reactive()
                // ->afterStateUpdated(function (Closure $set, $state) {

                //     dd($state);
                //     // $this->dayData = DayRecord::where('id', $state)->first();
                //     // $data = DayLogin::orderBy('created_at', 'desc')->where('day_record_id', $state)->whereHas('logout', function ($query) {
                //     //     $query->whereIn('status', ['Logged out', 'Did Not Logout']);
                //     // })->get();
                //     // $this->logins = $data;
                    
                // })->searchable(),

                // Select::make('courseSelected')->options(collect(Course::query()->pluck('name', 'id'))->prepend('All','all')->toArray())->searchable()->columnSpan(2)->label('Student course')->reactive()->disablePlaceholderSelection()->afterStateUpdated(function (Closure $get, Closure $set, $state) {
                    
                //     if(!empty($this->student) && !empty($this->student->course)){
                //         dd('student');
                //     }else{

                //     }
                  
                // }),
                // Select::make('yearSelected')->options([
                //     'all' => 'All',
                //     '1st Year' => '1st Year',
                //     '2nd Year' => '2nd Year',
                //     '3rd Year' => '3rd Year',
                //     '4th Year' => '4th Year',
                //     // '5th Year' => '5th Year',
                // ])->columnSpan(2)->label('Student year')->reactive()->afterStateUpdated(function (Closure $get, Closure $set, $state) {



                //     dd($state);
                // })->default('all')->disablePlaceholderSelection(),

                // Select::make('selectedStatus')->options([
                //     'all'=> 'All',
                //     'Logged out'=> 'Logged out',
                //     'Did Not Logout'=> 'Did Not Logout',
                //     'Not Logout'=> 'Currently Inside'
                // ])->columnSpan(2)->label('Record status')->reactive()->default('all')
                // ->disablePlaceholderSelection()
                // ->afterStateUpdated(function (Closure $get, Closure $set, $state) {

                    
                //     // dd($state);
                //     if(!empty($get('daySelected'))){
                        
                //         if($get('name')){
                //             $this->student = Student::where('id', $get('name'))->first();
                //             $this->logins = Daylogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
                //             ->when($state != 'all', function ($query) use ($state) {
                //                 $query->whereHas('logout', function ($query) use ($state) {
                //                     $query->where('status', $state);
                //                 });
                //             })
                //             ->where('student_id', $this->student->id)

                //             ->get();
                //         }

                //     }

                  
                    
                    
                // }),

                // Select::make('courseSelected')->options(function(){
                //     return collect(Course::query()->pluck('name', 'id'))->prepend('All','all')->toArray();
                // })
                // ->default('all')
                // ->label('Course Name')
                // ->columnSpan(2)
                // ->reactive()->default('all')->disablePlaceholderSelection()
                // ->afterStateUpdated(function (Closure $get, Closure $set, $state) {

                //     if (!empty($this->student)) {
                //         if(!empty($this->student->course)){

                //             if ($this->student->course->id != $state) {
                    
                //                 $this->student = Student::where('id', $this->student->id)
                //                     ->whereHas('course', function ($query) use ($state) {
                //                         $query->where('id', $state);
                //                     })->first();
                    
                //                 $this->logins = DayLogin::orderBy('created_at', 'desc')
                //                     ->where('day_record_id', $get('daySelected'))
                //                     ->when($state != 'all', function ($query) use ($state) {
                //                         $query->whereHas('logout', function ($query) use ($state) {
                //                             $query->where('status', $state);
                //                         });
                //                     })
                //                     ->where('student_id', $this->student->id)
                //                     ->get();
                //             }
                //         }
                //     }

                // })
                // ,

                Select::make('selectedPeriod')
                ->options([
                    'all' => 'All',
                    'am' => 'AM',
                    'pm' => 'PM',
                ])
                ->label('Time period')
                ->columnSpan(2)
                ->reactive()
                ->default('all')
                ->disablePlaceholderSelection()
                ->afterStateUpdated(function (Closure $get, Closure $set, $state) {
                 
                    if (!empty($get('daySelected'))) {
                        $this->logins = collect(); // Initialize as an empty collection
            
                        if ($get('name')) {

                            $this->student = Student::find($get('name'));
                         
                            $this->logins = DayLogin::orderBy('created_at', 'desc')
                                ->where('day_record_id', $get('daySelected'))
                                // ->when($get('selectedStatus') != 'all', function ($query) use ($get) {
                                //     $query->whereHas('logout', function ($query) use ($get) {
                                //         $query->where('status', $get('selectedStatus'));
                                //     });
                                // })
                                ->when($state != 'all', function ($query) use ($state) {
                                    
                                    if ($state == 'am') {
                                      
                                        $query->whereTime('created_at', '<', '12:00:00');
                                    }
                                    if ($state == 'pm') {
                                        $query->whereTime('created_at', '>=', '12:00:00');
                                    }
                                })
                                ->where('student_id', $this->student->id)   
                                ->get();
                        }
                    }
                })
            
            ]),
           
            // ...
        ];
    } 

}
