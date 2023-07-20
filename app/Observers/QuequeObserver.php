<?php

namespace App\Observers;

use App\Models\Queque;

class QuequeObserver
{
    /**
     * Handle the Queque "created" event.
     */
    public function created(Queque $queque): void
    {
        //
    }

    /**
     * Handle the Queque "updated" event.
     */
    public function updated(Queque $queque): void
    {
        //
    }

    /**
     * Handle the Queque "deleted" event.
     */
    public function deleted(Queque $queque): void
    {
        $queque->transaction()->delete();
    
    }

    /**
     * Handle the Queque "restored" event.
     */
    public function restored(Queque $queque): void
    {
        //
    }

    /**
     * Handle the Queque "force deleted" event.
     */
    public function forceDeleted(Queque $queque): void
    {
        //
    }
}
