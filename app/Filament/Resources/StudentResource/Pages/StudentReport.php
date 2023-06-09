<?php

namespace App\Filament\Resources\StudentResource\Pages;

use Closure;
use Filament\Forms;
use App\Models\Course;
use App\Models\Student;
use App\Models\DayLogin;
use App\Models\DayRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource;

class StudentReport extends Page implements Forms\Contracts\HasForms 
{

    use Forms\Concerns\InteractsWithForms; 
    protected static string $resource = StudentResource::class;
    protected static string $view = 'filament.resources.student-resource.pages.student-report';


    public $logins=[];
    public $dayData;
    public $student;
    public $courseSelected;
    public $yearSelected;
    public $selectedPeriod;
    public $selectedStatus;
    public $name;
    

    public $idNumber;

    

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
                ->default(DayRecord::latest()->first()->id)
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
                ->options(Student::whereHas('logins')->select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), 'id')->pluck('full_name', 'id')->toArray())
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
                        ->when($get('selectedStatus') != 'all', function ($query) use ($get) {
                            $query->whereHas('logout', function ($query) use ($get) {
                                $query->where('status', $get('selectedStatus'));
                            });
                        })
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
                //     dd($state);
                  
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

                Select::make('selectedStatus')->options([
                    'all'=> 'All',
                    'Logged out'=> 'Logged out',
                    'Did Not Logout'=> 'Did Not Logout',
                ])->columnSpan(2)->label('Record status')->reactive()->default('all')
                ->disablePlaceholderSelection()
                ->afterStateUpdated(function (Closure $get, Closure $set, $state) {

                    
                    // dd($state);
                    if(!empty($get('daySelected'))){
                        
                        if($get('name')){
                            $this->student = Student::where('id', $get('name'))->first();
                            $this->logins = Daylogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
                            ->when($state != 'all', function ($query) use ($state) {
                                $query->whereHas('logout', function ($query) use ($state) {
                                    $query->where('status', $state);
                                });
                            })
                            ->where('student_id', $this->student->id)

                            ->get();
                        }

                    }

                  
                    
                    
                }),

                Select::make('selectedPeriod')->options([
                    'all'=> 'All',
                    'am'=> 'am',
                    'pm'=> 'pm',
                ])->label('Time period')->reactive()->default('all')->disablePlaceholderSelection()
                ->afterStateUpdated(function (Closure $get, Closure $set, $state) {

                    if(!empty($get('daySelected'))){
                        
                        if($get('name')){
                            $this->student = Student::where('id', $get('name'))->first();
                            $this->logins = Daylogin::orderBy('created_at', 'desc')->where('day_record_id', $get('daySelected'))
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
                            ->where('student_id', $this->student->id)
                            ->get();
                        }

                    }
                    
            
                }),
            ]),
           
            // ...
        ];
    } 


}

