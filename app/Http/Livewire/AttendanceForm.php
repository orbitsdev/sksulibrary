<?php

namespace App\Http\Livewire;

use App\Models\Quote;
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
    public $quotes = [];
    public $confirmLogin = false;
    public $isConfirmationShow = false;
    protected $listeners = ['test'=> 'test'];
   
    
    
    public function test(){
        $this->dispatchBrowserEvent('name-updated', ['newName' => 'newName']);
    }
    public function mount(){
  
    }

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

                $this->student = Student::where('id_number',$this->barcode)->first();
                // $this->todayRecord = $this->getLatestDayRecord();
             
                if($this->student !== null){
                    

                        $this->todayRecord = DayRecord::latest()->first();

                        if($this->todayRecord !== null){
                            $this->callProcess();
                            

                          
                        
                       
                        
                    }else{
                        
                        $this->todayRecord   = DayRecord::create();
                        $this->callProcess();
                        
                        
                        // $this->createDayLoginRecordWithLogout();
                        
                    }
                    

                }else{
                    $this->showError('Error', "Student account not found! Please register to admin" ,'not-found' );
                }
            }else{
                $this->showError('Error', "Please enter id number",'not-found' );
            }
               

            DB::commit(); 
            $this->barcode =null;
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

        // sleep(3);

        // $this->hasError = false;

    }

    
    
    public function showSuccess($header = 'Saved', $body = "Data was successfully saved", ){

        
        $this->isSuccess = true;
        $this->student = Student::where('id_number', $this->barcode)->first();

    }

    public function createDayLoginRecordWithLogout() {
        $newLoginRecord = $this->todayRecord->daylogins()->create([ 'student_id' => $this->student->id, ]);
        $newLogoutRecord = $newLoginRecord->logout()->create(['status'=> 'Not Logout']);
        
        // $this->student = Student::where('id_number', $this->barcode)->first();
        // $this->clearInformation();
        // $this->succesNotification();
        // $this->isSuccess = true;
    }


    public function updateLogoutRecordStatus($logoutRecord){
        $logoutRecord->update(['status' => 'Logged out']);
        // $this->student = Student::where('id_number', $this->barcode)->first();
        // $this->isSuccess = true;
        // $this->clearInformation();
        // $this->succesNotification();

    }

    public function createLogoutRecord($studentLoginRecord){
        $newLogoutRecord = $studentLoginRecord->logout()->create(['status'=> 'Logged out']);
        // $this->student = Student::where('id_number', $this->barcode)->first();
        // $this->clearInformation();
        // $this->succesNotification();


    }

    public function readBarCodeManually(): void
    {
        $this->readBarCode();
    }

    public function clearError(){
        if($this->hasError ==true){
            $this->hasError = false;
        }
    }


    public function showStudentDetails(){
        $this->isSuccess =true;
    }
    public function callProcess(){
        $this->clearError();
        // $this->isSuccess =true;
        $this->processLog();
    }


    public function processLog(){
        
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
                                $this->todayRecord   = DayRecord::create();
                                $this->createDayLoginRecordWithLogout();
                            
                            }

                            
    }


    public function showConfirmation (){
        $this->isConfirmationShow = true;
    }

    
    public function cancelProcess(){

        $this->clearInformation();
    }

    public function clearInformation(){

        $this->isConfirmationShow = false;
        $this->isSuccess = false;
        $this->barcode = null;
        $this->student = null;
        $this->todayRecord = null;
    }

    public function succesNotification(){
        $this->dialog()->success(
            $title = 'Saved',
           
        );
    }




    
    
}
