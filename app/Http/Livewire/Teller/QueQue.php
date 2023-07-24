<?php

namespace App\Http\Livewire\Teller;

use App\Models\Teller;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Transaction;
use App\Models\Queque as QuequeModel;

class QueQue extends Component
{
    use Actions;

    public $teller;
    public $currentQueque;
    public $pendingQueque=[];
    public $holdTransaction=[];
    public $selectedHoldTransaction;

    public function mount(){
        if(session()->has('teller_id')){
            
            $this->teller = Teller::find(session('teller_id'));
            $this->getUnfinishTransaction();
         
        }
    }

    public function updatedselectedHoldTransaction()
    {

        if(empty($this->currentQueque)){
            

            $this->selectNumber($this->selectedHoldTransaction);
        

        }else{
            $this->dialog()->info(
    
                $title = 'You can only select number once at a time',
    
                $description = 'Please Finish or Cancel the transaction first'
    
            );
        }
    }



    public function getUnfinishTransaction(){

       $unfinishTransaction =  Transaction::latest()
        ->where('teller_id', $this->teller->id)
        ->whereHas('queque', function ($query) {
            $query->where('status', 'processing');
        })
        ->first();

        if($unfinishTransaction){
        $this->currentQueque = $unfinishTransaction->queque;
        }
    }

    public function callNextPerson(){

            $latestQueque = QuequeModel::latest()->first();

            if(empty($latestQueque)){
                $newQueQue = QuequeModel::create([
                    'number' => 1,
                    'status' => 'waiting',
                ]);
            }  else{
                $latestNumber = $latestQueque->number;
                
                $newQueQue = QuequeModel::create([
                    'number' => $latestNumber+1,
                    'status' => 'waiting',
                ]);

            } 

    }


    public function render()
    {   

        $this->pendingQueque = QuequeModel::oldest()->where('status', 'waiting')->take(3)->get();
        $this->holdTransaction = QuequeModel::where('status','hold')->whereHas('transactions', function($query) {
            $query->where('teller_id', $this->teller->id);
        })->latest()->get();
      
        // $this->pendingQueque =QuequeModel::latest()->take(3)->get();
        return view('livewire.teller.que-que',[
            'waitingNumbers' => $this->pendingQueque,
            'holdnumbers' => $this->holdTransaction,
        ]);
    }


    public function selectNumber($ququeId){
      

        if(empty($this->currentQueque)){
            $selectedNumber = QuequeModel::find($ququeId);
            if($selectedNumber){
                
                if($selectedNumber->status != 'waiting'  && $selectedNumber->status != 'hold'){
                    $this->dialog()->error(
    
                        $title = 'Error !!!',
                        $description = 'Number is already taken by another teller'
                    );
                } else{
    
                     $this->currentQueque = $selectedNumber;
                     $this->currentQueque->status = 'processing';
                     $this->currentQueque->save();

                     Transaction::create([
                        'queque_id'=> $this->currentQueque->id,
                        'teller_id'=> $this->teller->id,
                     ]);
                }
    
            }else{
                $this->dialog()->error(
    
                    $title = 'Not Found',
        
                    $description = 'Number is not found in the database it might be already deleted'
        
                );
            }
        }else{
            $this->dialog()->info(
    
                $title = 'You can only select number one at a time',
    
                $description = 'Please Finish the transaction first'
    
            );
        }
            
       
       
       


       
    }

    public function completeTransaction($ququeId){
        $selectedNumber = QuequeModel::find($ququeId);
        $this->currentQueque->status = 'completed';
        $this->currentQueque->save();

        $this->dialog()->success(

            $title = 'Transaction complete',

            $description = 'Your Transaction was completed'

        );
        $this->currentQueque = null;
        
    }
    public function cancelTransaction($ququeId){
        
        $selectedNumber = QuequeModel::find($ququeId);
        $this->currentQueque->status = 'waiting';
        $this->currentQueque->save();
        $this->currentQueque->transactions()->delete();
        $this->currentQueque = null;
        $this->dialog()->success(

            $title = 'Transaction canceled',

            $description = 'Your Transaction was canceled'

        );
      
        
    }

    public function holdTransaction($ququeId){
        $selectedNumber = QuequeModel::find($ququeId);
        $this->currentQueque->status = 'hold';
        $this->currentQueque->save();

        // $this->dialog()->success(

        //     $title = 'Transaction canceled',

        //     $description = 'Your Transaction was canceled'

        // );
        $this->currentQueque = null;

        $this->dialog()->success(

            $title = 'Transaction hold',

            $description = ' Transaction was hold'

        );
    }


    public function callNumber($number){
       $this->emit('shoutNumber', $number);

    }

    public function logout(){
         session()->forget('teller_id');
 
         // Redirect the teller to the desired page
         return redirect()->route('teller.login');
     }
}
