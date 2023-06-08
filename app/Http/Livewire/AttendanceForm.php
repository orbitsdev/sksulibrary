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


    public $isSuccess = false;
    public $hasError = false;
    public $user;
    public $student;
    public $todayRecord;
    public $isManualInputBarCode = false;

    public function render()
    {
        return view('livewire.attendance-form');
    }


    public function updatedbarcode()
    {

        if($this->isManualInputBarCode == false){

            $this->readBarCode();
        }
    }

    public function readBarCode()
    {


        

        if (!empty($this->barcode)) {

            $this->student = Student::find($this->barcode);
            $this->todayRecord = $this->getLatestDayRecord();

            if ($this->isStudentExist($this->student) ) {

              

                if ($this->isRecordExist($this->todayRecord)) {

                    $nowDate = now()->startOfDay();
                    $activeRecord = $this->todayRecord->created_at->startOfDay();

                    if ($nowDate->equalTo($activeRecord)) {

                        /// check if it has login record 
                        if ($this->studentHasLoginRecord($this->student->id)) {

                            //check latest record if it has logout record where active not yet loggout

                            $latestStudentLoginRecord = $this->getStudentLatestLoginRecord($this->student->id);

                            if ($latestStudentLoginRecord->whereHas('logout', function ($query) {$query->where('status', 'not-yet-logout');})->exists()) {
                               
                                $this->updateLogoutRecord($latestStudentLoginRecord, 'loggedout');
                                $this->showSuccess();

                            } else if ($latestStudentLoginRecord->whereHas('logout', function ($query) {$query->where('status', 'loggedout');})->exists()) {

                                $this->todayRecord = $this->createNewDayRecord();
                                $newLoginRecord = $this->createNewLoginRecord($this->todayRecord, $this->student);
                                $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                                $this->showSuccess();


                            } else if ($latestStudentLoginRecord->has('logout')->exists()) {

                                // meaning if the data has been set as student did not logout on, we must create new  record
                                $this->todayRecord = $this->createNewDayRecord();
                                $newLoginRecord = $this->createNewLoginRecord($this->todayRecord, $this->student);
                                $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                                $this->showSuccess();

                            } else {

                                $this->createNewLogoutRecord($latestStudentLoginRecord);
                                $this->showSuccess();

                            }

                            

                        } else {

                           
                            $newLoginRecord = $this->createNewLoginRecord($this->todayRecord , $this->student);
                            $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                            $this->showSuccess();

                        }
                      
                    } else if ($nowDate->greaterThan($activeRecord)) {

                        $this->todayRecord = $this->createNewDayRecord();
                        $newLoginRecord = $this->createNewLoginRecord($this->todayRecord, $this->student);
                        $newLogoutRecord = $this->createNewLogoutRecord($newLoginRecord);
                        $this->showSuccess();

                    } else {
                            
                            $this->showError();
                    }


                } else {

                    $this->todayRecord = $this->createNewDayRecord();
                    $newLoginRecord = $this->createNewLoginRecord($this->todayRecord, $this->student);
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

    public function getLatestDayRecord(): null|DayRecord{
                
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





    public function showError($header = 'Error', $body = "No student found"){
        $this->hasError = true;
    }

    public function showSuccess($header = 'Saved', $body = "Data was successfully saved", ){
       
        $this->isSuccess = true;

        $this->student = Student::find($this->barcode);


    }


    public function closeError(){

        $this->hasError = false;

    }

    public function readBarCodeManually(): void
    {
        $this->readBarCode();
    }

    
}
