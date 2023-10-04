<?php

namespace App\Filament\Pages;

use Closure;
use Filament\Forms;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use App\Models\DayLogin;
use Filament\Pages\Page;
use App\Models\DayRecord;
use App\Exports\TopVisitorExport;
use App\Exports\DailyVisitorExport;
use Filament\Forms\Components\Grid;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Pages\DailyVisitors;
use Filament\Forms\Components\Select;

class DailyVisitors extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.daily-visitors';

    public $students = [];
    public $daySelected;
    public $campusSelected;
    public $courseSelected;
    public $selectedStatus;
    public $dayData;


    public function exportToExcel(){
        // dd($this->dayData);
    $filename = 'DAILY-VISITORS-' . optional(Dayrecord::find($this->daySelected))->created_at->format('Y-m-d') ?? now()->format('Y-m-d');
        
        return Excel::download(new DailyVisitorExport($this->students), $filename.'.xlsx');
    }

    public function print()
    {
        $this->dispatchBrowserEvent('printVisitors');
    }
    public function mount(): void
    {
        $this->form->fill();
        $this->campusSelected = 'all';
        $this->selectedStatus = 'all';
        $day = DayRecord::orderBy('created_at', 'desc')->first();
        if (!empty($day)) {
            $this->daySelected = $day->id;
            $this->dayData =$day;
            $this->students = Student::whereHas('logins.dayRecord', function ($query) use ($day) {
                $query->where('id', $day->id);
            })->get();




            //    $this->logins = DayLogin::latest()->where('day_record_id', $day->id)->whereHas('logout', function ($query) {
            //        $query->whereIn('status', ['Logged out', 'Did Not Logout']);
            //    })->get();

        }
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
                        ->afterStateUpdated(function (Closure $set, Closure $get, $state) {

                            $this->dayData = DayRecord::where('id', $state)->first();
                            $this->students = Student::whereHas('logins.dayRecord', function ($query) use ($state, $get) {
                                $query->where('id', $state)
                                    ->when($get('campusSelected') != 'all', function ($query) use ($get) {
                                        $query->where('campus_id', (int)$get('campusSelected'));
                                    });
                            })->get();





                            // $data = DayLogin::orderBy('created_at', 'desc')->where('day_record_id', $state)->whereHas('logout')->get();
                            // $this->logins = $data;

                        }),
                    Select::make('campusSelected')
                        ->options(collect(Campus::query() // Filter courses based on the selected campus.
                            ->pluck('name', 'id'))
                            ->prepend('All', 'all')
                            ->toArray())
                        ->columnSpan(2)
                        ->searchable()
                        ->label('Campus')
                        ->reactive()
                        ->default('all')
                        ->afterStateUpdated(function (Closure $get, Closure $set, $state) {


                            if (!empty($get('daySelected'))) {
                                $this->students = Student::whereHas('logins.dayRecord', function ($query) use ($state, $get) {
                                    $query->where('id', $get('daySelected'))
                                        ->when($state != 'all', function ($query) use ($state) {
                                            $query->where('campus_id', (int)$state);
                                        });
                                })

                                    ->get();

                                if ($get('courseSelected') != 'all') {
                                    $set('courseSelected', 'all');
                                }
                                // $set('courseSelected','all');
                            }
                        }),
                    Select::make('courseSelected')
                        ->options(function (Closure $get, Closure $set, $state) {
                            return collect(
                                Course::query()
                                    ->when($get('campusSelected') != 'all' && !empty($get('campusSelected')), function ($query) use ($get) {
                                        $query->whereHas('campus', function ($q) use ($get) {
                                            $q->where('id', (int)$get('campusSelected'));
                                        });
                                    }) // Filter courses based on the selected campus.
                                    ->pluck('name', 'id')
                            )->prepend('All', 'all')
                                ->toArray();
                        })
                        ->columnSpan(2)
                        ->searchable()
                        ->label('Course')
                        ->reactive()
                        ->default('all')
                        ->afterStateUpdated(function (Closure $get, Closure $set, $state) {


                            if (!empty($get('daySelected'))) {
                                $this->students = Student::whereHas('logins.dayRecord', function ($query) use ($get) {
                                    $query->where('id', $get('daySelected'));
                                })
                                    ->when($get('campusSelected') != 'all', function ($query) use ($get) {
                                        // Assuming 'course' is the relationship in the 'Student' model.
                                        $query->whereHas('course.campus', function ($q) use ($get) {
                                            $q->where('id', (int)$get('campusSelected'));
                                        });
                                    })
                                    ->when($state != 'all', function ($query) use ($state) {
                                        // Assuming 'course' is the relationship in the 'Student' model.
                                        $query->where('course_id', (int)$state);
                                    })
                                    ->get();
                            }
                        }),



                ]),
        ];
    }
}
