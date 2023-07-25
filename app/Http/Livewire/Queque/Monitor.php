<?php

namespace App\Http\Livewire\Queque;

use App\Models\Queque;
use Livewire\Component;

class Monitor extends Component
{   

    public $currentTransaction = [];
    public $waitingTransaction = [];
    public function render()
    {

        $this->currentTransaction = Queque::oldest()->where('status', 'processing')->whereHas('transaction')->with('transaction.teller')->get();
        $this->waitingTransaction = Queque::oldest()->where('status','waiting')->with('transaction.teller')->take(4)->get();
     
        return view('livewire.queque.monitor',[
            'currentTransactions' => $this->currentTransaction,
            'waitingTransactions' => $this->waitingTransaction,
        ]);
    }
}
