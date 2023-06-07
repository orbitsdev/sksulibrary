<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\DayLogin;
use App\Models\DayRecord;
use WireUi\Traits\Actions;
use Illuminate\Support\Carbon;

class AttendanceForm extends Component
{


    use Actions;
    public $barcode;


    public $showModal = false;

    public $user;
    public $student;
    public $dateNow;
    public $dateRecording;
    public function render()
    {
        return view('livewire.attendance-form');
    }


    public function updatedbarcode()
    {
        $this->readBarCode();
    }

    public function readBarCode()
    {


        /// ATTENDANCE  PROCESS

        /// 1 query student base on id number and check
                // if null
                ///  show modal error user not found
                // if not null 
        /// 2 query the actibes or latest day.  the currently recoding data
                // if null 
                        //create new day record
                // if not null 
                // 3.  compaire the day to day to the currently active day 
                        // if equal 
                                    // create new day record
                                    // chech $student if has login 
                                // if greater than 
                                        // create new date record and save
                                            //and start the process again

        if (!empty($this->barcode)) {

            $this->student = Student::find($this->barcode);

            if ($this->student != null && !empty($this->student)) {

                $dayRecord = DayRecord::latest()->first();

                if ($dayRecord != null) {

                    $nowDate = now()->startOfDay();
                    $activeRecord = $dayRecord->created_at->startOfDay();

                    // $nowDate = Carbon::parse('2023-06-06');
                    // $activeRecord = Carbon::parse('2023-06-0');

                    if ($nowDate->equalTo($activeRecord)) {


                        
                        /// check if it has login record 
                        if(DayLogin::where('student_id', $this->student->id)->exists()){
                            
                            //check latest record if it has logout record where active not yet loggout

                            $latestLoginRecord = DayLogin::where('student_id', $this->student->id)->latest()->first();

                            if($latestLoginRecord->whereHas('logout', function($query) {
                                $query->where('status', 'not-yet-logout');
                            })->exists()){

                                dd('has logout record and the logout status is not-yet-logout');
                            
                            }else if($latestLoginRecord->whereHas('logout', function($query) {
                                $query->where('status', 'loggedout');
                            })->exists()){
                                
                                dd('has logout record with loggoute status');
                            }else if($latestLoginRecord->has('logout')->exists()){

                                dd('has logout but different status');

                            }else{
                                
                                dd('totaly logout record so create new  record here');

                            }

                            dd($latestLoginRecord);

                            dd('student has  login record');

                        }else{
                            
                            $new_day_login_record = $this->student->logins()->create([
                                'day_record_id' => $dayRecord->id,
                                ]
                            );

                            $new_day_logout_record =  $new_day_login_record->logout()->create(
                            [
                                'status'=> 'not-yet-logout',    
                            ]);

                            dd('studen has no login record so we create new data');
                        }
                        // dd($this->student);
                        // $newLogi $dayRecord->daylogins()->create([
                        //     'student_id' => $this->student->id,
                        // ]);

                        // dd('eqqual');
                    } else if ($nowDate->greaterThan($activeRecord)) {
                        dd('greater than');
                    } else {
                        dd('less than');
                    }
                } else {
                    $newRecord = DayRecord::create();
                    // dd('not exist');
                    dd($newRecord);
                }
            } else {
                $this->dialog()->error(
                    $title = 'Error !!!',
                    $description = 'No student found'
                );
            }
        }
    }


    public function save(): void
    {

        // use a simple syntax: success | error | warning | info
        $this->dialog()->success(
            $title = 'Profile saved',
            $description = 'Your profile was successfully saved'
        );
    }
}
