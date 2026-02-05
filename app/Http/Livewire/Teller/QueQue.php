<?php

namespace App\Http\Livewire\Teller;

use Exception;
use App\Models\Teller;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\Queque as QuequeModel;

class QueQue extends Component
{
    use Actions;

    public $teller;
    public $currentQueque;
    public $pendingQueque = [];
    public $holdTransaction = [];
    public $selectedHoldTransaction;

    public function mount()
    {
        if (session()->has('teller_id')) {
            $this->teller = Teller::find(session('teller_id'));

            // If teller was deleted from database, clear session and redirect
            if (!$this->teller) {
                session()->forget('teller_id');
                return redirect()->route('teller.login');
            }

            $this->getUnfinishTransaction();
        }
    }

    public function updatedselectedHoldTransaction()
    {

        if (empty($this->currentQueque)) {


            $this->selectNumber($this->selectedHoldTransaction);
        } else {
            $this->dialog()->info(

                $title = 'You can only select number once at a time',

                $description = 'Please Finish or Cancel the transaction first'

            );
        }
    }



    public function getUnfinishTransaction()
    {

        $unfinishTransaction =  Transaction::latest()
            ->where('teller_id', $this->teller->id)
            ->whereHas('queque', function ($query) {
                $query->where('status', 'processing');
            })
            ->first();

        if ($unfinishTransaction) {
            $this->currentQueque = $unfinishTransaction->queque;
        }
    }

    public function callNextPerson()
    {
        if (!$this->teller) {
            $this->dialog()->error(
                $title = 'Session Expired',
                $description = 'Please login again'
            );
            return redirect()->route('teller.login');
        }

        DB::beginTransaction();

        try {
            // Lock the table to prevent race conditions when getting the latest number
            $latestQueque = QuequeModel::lockForUpdate()->latest()->first();

            if (empty($latestQueque)) {
                $newNumber = 1;
            } else {
                $newNumber = $latestQueque->number + 1;
            }

            QuequeModel::create([
                'number' => $newNumber,
                'status' => 'waiting',
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $this->dialog()->error(
                $title = 'Error',
                $description = 'Failed to create queue number. Please try again.'
            );
        }
    }


    public function render()
    {
        // Handle null teller (session expired or teller deleted)
        if (!$this->teller) {
            return redirect()->route('teller.login');
        }

        $this->pendingQueque = QuequeModel::oldest()->where('status', 'waiting')->take(4)->get();
        $this->holdTransaction = QuequeModel::where('status', 'hold')->whereHas('transactions', function ($query) {
            $query->where('teller_id', $this->teller->id);
        })->latest()->get();

        return view('livewire.teller.que-que', [
            'waitingNumbers' => $this->pendingQueque,
            'holdnumbers' => $this->holdTransaction,
        ]);
    }


    public function selectNumber($ququeId)
    {
        if (!$this->teller) {
            $this->dialog()->error(
                $title = 'Session Expired',
                $description = 'Please login again'
            );
            return redirect()->route('teller.login');
        }

        if (!empty($this->currentQueque)) {
            $this->dialog()->info(
                $title = 'You can only select one number at a time',
                $description = 'Please finish the transaction first'
            );
            return;
        }

        DB::beginTransaction();

        try {
            // Lock the row to prevent race condition
            $selectedNumber = QuequeModel::lockForUpdate()->find($ququeId);

            if (!$selectedNumber) {
                DB::rollback();
                $this->dialog()->error(
                    $title = 'Not Found',
                    $description = 'Number is not found in the database, it might be already deleted'
                );
                return;
            }

            if ($selectedNumber->status != 'waiting' && $selectedNumber->status != 'hold') {
                DB::rollback();
                $this->dialog()->error(
                    $title = 'Error',
                    $description = 'Number is already taken by another teller'
                );
                return;
            }

            $selectedNumber->status = 'processing';
            $selectedNumber->save();

            // Only create transaction if one doesn't exist for this queue (handles hold re-selection)
            $existingTransaction = Transaction::where('queque_id', $selectedNumber->id)
                ->where('teller_id', $this->teller->id)
                ->first();

            if (!$existingTransaction) {
                Transaction::create([
                    'queque_id' => $selectedNumber->id,
                    'teller_id' => $this->teller->id,
                ]);
            }

            $this->currentQueque = $selectedNumber;

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $this->dialog()->error(
                $title = 'Error',
                $description = 'Failed to select number. Please try again.'
            );
        }
    }

    public function completeTransaction($ququeId)
    {
        if (!$this->currentQueque) {
            $this->dialog()->error(
                $title = 'Error',
                $description = 'No transaction is currently selected'
            );
            return;
        }

        // Verify the queque still exists and matches
        $queque = QuequeModel::find($ququeId);
        if (!$queque || $queque->id !== $this->currentQueque->id) {
            $this->dialog()->error(
                $title = 'Error',
                $description = 'Transaction mismatch. Please refresh the page.'
            );
            $this->currentQueque = null;
            return;
        }

        $this->currentQueque->status = 'completed';
        $this->currentQueque->save();
        $this->currentQueque = null;

        $this->dialog()->success(
            $title = 'Transaction Complete',
            $description = 'Your transaction was completed'
        );
    }

    public function cancelTransaction($ququeId)
    {
        if (!$this->currentQueque) {
            $this->dialog()->error(
                $title = 'Error',
                $description = 'No transaction is currently selected'
            );
            return;
        }

        // Verify the queque still exists and matches
        $queque = QuequeModel::find($ququeId);
        if (!$queque || $queque->id !== $this->currentQueque->id) {
            $this->dialog()->error(
                $title = 'Error',
                $description = 'Transaction mismatch. Please refresh the page.'
            );
            $this->currentQueque = null;
            return;
        }

        $this->currentQueque->status = 'waiting';
        $this->currentQueque->save();
        $this->currentQueque->transactions()->delete();
        $this->currentQueque = null;

        $this->dialog()->success(
            $title = 'Transaction Canceled',
            $description = 'Your transaction was canceled'
        );
    }

    public function holdTransaction($ququeId)
    {
        if (!$this->currentQueque) {
            $this->dialog()->error(
                $title = 'Error',
                $description = 'No transaction is currently selected'
            );
            return;
        }

        // Verify the queque still exists and matches
        $queque = QuequeModel::find($ququeId);
        if (!$queque || $queque->id !== $this->currentQueque->id) {
            $this->dialog()->error(
                $title = 'Error',
                $description = 'Transaction mismatch. Please refresh the page.'
            );
            $this->currentQueque = null;
            return;
        }

        $this->currentQueque->status = 'hold';
        $this->currentQueque->save();
        $this->currentQueque = null;

        $this->dialog()->success(
            $title = 'Transaction On Hold',
            $description = 'Transaction was put on hold'
        );
    }


    public function callNumber($number)
    {
        $this->emit('shoutNumber', $number);
    }

    public function logout()
    {
        session()->forget('teller_id');

        // Redirect the teller to the desired page
        return redirect()->route('teller.login');
    }
}
