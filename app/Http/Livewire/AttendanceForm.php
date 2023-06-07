<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\DayLogin;
use App\Models\DayLogout;
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

            if ($this->isStudentExist($this->student) ) {

                $latestDayRecord = $this->getLatestDayRecord();

                if ($this->isRecordExist($latestDayRecord)) {

                    $nowDate = now()->startOfDay();
                    $activeRecord = $latestDayRecord->created_at->startOfDay();

                    if ($nowDate->equalTo($activeRecord)) {

                        /// check if it has login record 
                        if ($this->studentHasLoginRecord($this->student->id)) {

                            //check latest record if it has logout record where active not yet loggout

                            $latestStudentLoginRecord = $this->getStudentLatestLoginRecord($this->student->id);

                            if ($latestStudentLoginRecord->whereHas('logout', function ($query) {$query->where('status', 'not-yet-logout');})->exists()) {
                               
                                $this->updateLogoutRecord($latestStudentLoginRecord, 'loggedout');
                                $this->showSuccess();

                            } else if ($latestStudentLoginRecord->whereHas('logout', function ($query) {$query->where('status', 'loggedout');})->exists()) {

                                $newRecord = $this->createNewDayRecord();
                                $newLoginRecord = $this->createNewLoginRecord($newRecord, $this->student);
                                $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                                $this->showSuccess();


                            } else if ($latestStudentLoginRecord->has('logout')->exists()) {

                                // meaning if the data has been set as student did not login on, we must create new  record
                                $newRecord = $this->createNewDayRecord();
                                $newLoginRecord = $this->createNewLoginRecord($newRecord, $this->student);
                                $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                                $this->showSuccess();

                            } else {

                                $this->createNewLogoutRecord($latestStudentLoginRecord);
                                $this->showSuccess();

                            }

                            

                        } else {

                           
                            $newLoginRecord = $this->createNewLoginRecord($latestDayRecord , $this->student);
                            $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);

                            dd('studen has no login record so we create new data');

                        }
                      
                    } else if ($nowDate->greaterThan($activeRecord)) {

                        $newRecord = $this->createNewDayRecord();
                        $newLoginRecord = $this->createNewLoginRecord($newRecord, $this->student);
                        $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                        $this->showSuccess();

                    } else {
                            
                            $this->showError();
                    }


                } else {

                    $newRecord = $this->createNewDayRecord();
                    $newLoginRecord = $this->createNewLoginRecord($newRecord, $this->student);
                    $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                    $this->showSuccess();

                }
            } else {
                $this->showError();
            }
        }
    }

    public function createNewDayRecord(): DayRecord
    {

        $newRecord = DayRecord::create();

        return $newRecord;
    }

    public function createNewLoginRecord(DayRecord $record, Student $student): DayLogin
    {

        $newLoginRecord = $record->daylogins()->create([
            'student_id' => $student->id,
        ]);

        return $newLoginRecord;
    }

    public function createNewLogoutRecord(DayLogin $dayLogin): DayLogout
    {

        $newLogoutRecord = $dayLogin->logout()->create([
            'status' => 'not-yet-logout',
        ]);

        return $newLogoutRecord;
    }

    

    public function isStudentExist( null|Student $student ): bool
    {
        if ($student != null && !empty($student)) {
            return true;
        } else {
            return false;
        }
    }


    public function isRecordExist(null|DayRecord $record): bool  {
        if ($record != null && !empty($record)) {
            return true;
        } else {
            return false;
        }

    }

    public function getLatestDayRecord(): DayRecord{
                
            $record = DayRecord::latest()->first();
    
            return $record;
    }

    public function studentHasLoginRecord($studentId): bool{
            
            if(DayLogin::where('student_id', $studentId)->exists()){
                return true;
            }else{
                return false;
            }
    }


    public function getStudentLatestLoginRecord($studentId): DayLogin {

        $record = DayLogin::where('student_id', $studentId)->latest()->first();

        return $record;

    }

    public function updateLogoutRecord(DayLogin $daylogin, $value)
    {
        $daylogin->logout()->update([
            'status' => $value,
        ]);
    }


    public function processLogic()
    {
    }




    public function showError($header = 'Error', $body = "No student found"){
        $this->dialog()->error(
            $title = $header,
            $description = $body
        );
    }

    public function showSuccess($header = 'Saved', $body = "Data was successfully saved", ){
        $this->dialog([
            'title'       => $header,
            'description' => $body,
            'icon'        => 'success'
        ]);
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
