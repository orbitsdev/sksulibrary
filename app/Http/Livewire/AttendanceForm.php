<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\DayLogin;
use App\Models\DayLogout;
use App\Models\DayRecord;
use WireUi\Traits\Actions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class AttendanceForm extends Component
{


    use Actions;
    public $barcode;
    public $student;
    public $todayRecord;
    public $hasError = false;
    public $isSuccess = false;
    public $isManualInputBarCode = false;
    public $errorType = 'not-found';
    public $errorMessage='';
    public $errorHeader='';

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


        try{
            DB::beginTransaction();


            if (!empty($this->barcode)) {

                $this->student = Student::find($this->barcode);
                // $this->todayRecord = $this->getLatestDayRecord();
             
                if($this->student !== null){

                    $this->todayRecord = DayRecord::latest()->first();

                    if($this->todayRecord !== null){
                        

                        $nowDate = now()->startOfDay();
                        $activeRecord = $this->todayRecord->created_at->startOfDay();


                        if($nowDate->equalTo($activeRecord)){
                            
                            if( $studentLoginRecord =  $this->student->logins()->latest()->first()){    

                                if($logoutRecord = $studentLoginRecord->logout){
                                    

                                    if($logoutRecord->status == 'Not Logout'){

                                        $this->updateLogoutRecordStatus($logoutRecord);
                                      

                                    }else{
                                        $this->createDayLoginRecordWithLogout();
                                        
                                    }

                                }else{
                                    $this->createLogoutRecord($studentLoginRecord);
                                    
                                }
                              

                            }else{

                                $this->createDayLoginRecordWithLogout();
                              
                            }

                        }else{
                          
                            $this->createDayLoginRecordWithLogout();
                           
                        }
                        
                        // else if($nowDate->greaterThan($activeRecord)){
                        // }else{
                        //     dd('error for it is impossilble that  now date can be less than to the activerecord. unless  you modify it');
                        // }
                        // dd('continue the process');
                        
                    }else{
                        
                        $this->todayRecord   = DayRecord::create();
                        $this->createDayLoginRecordWithLogout();
                        
                    }
                    

                }else{
                    $this->showError('Error', "Please register first your barcode to the admin." ,'not-found' );
                }
            }
               

            DB::commit(); 
        }catch(QueryException $e){
            DB::rollBack(); 
            $this->showError( $e->getCode(), $e->getMessage() ,'exception' );
        }


        }


        public function updatedhasError()
        {   

            if($this->hasError == false){
                $this->errorType = 'not-found';
              
                $this->errorMessage = '';
                $this->errorHeader = '';
            }
    
          
        }


    public function showError($header = 'Error', $message = "An Error Occur" , $type= 'not-found' ){
        $this->hasError = true;
        $this->errorType = $type;
        $this->errorMessage = $message;
        $this->errorHeader = $header;
    }

    
    public function showSuccess($header = 'Saved', $body = "Data was successfully saved", ){

        
        $this->isSuccess = true;
        $this->student = Student::find($this->barcode);

    }

    public function createDayLoginRecordWithLogout() {
        $newLoginRecord = $this->todayRecord->daylogins()->create([  'student_id' => $this->student->id, ]);
        $newLogoutRecord = $newLoginRecord->logout()->create(['status'=> 'Not Logout']);
        $this->student = Student::find($this->barcode);
        $this->isSuccess = true;
    }


    public function updateLogoutRecordStatus($logoutRecord){
        $logoutRecord->update(['status' => 'Logged out']);
        $this->student = Student::find($this->barcode);
        $this->isSuccess = true;
    }

    public function createLogoutRecord($studentLoginRecord){
        $newLogoutRecord = $studentLoginRecord->logout()->create(['status'=> 'Logged out']);
        $this->student = Student::find($this->barcode);
        $this->isSuccess = true;
    }

    public function readBarCodeManually(): void
    {
        $this->readBarCode();
    }




    
    
}
