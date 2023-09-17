<?php

namespace App\Observers;

use App\Models\Campus;

class CampusObserver
{
    /**
     * Handle the Campus "created" event.
     */
    public function created(Campus $campus): void
    {
        //
    }

    /**
     * Handle the Campus "updated" event.
     */
    public function updated(Campus $campus): void
    {
        //
    }

    /**
     * Handle the Campus "deleted" event.
     */
    public function deleted(Campus $campus): void
    {
        $campus->courses()->delete();
    }

    /**
     * Handle the Campus "restored" event.
     */
    public function restored(Campus $campus): void
    {
        //
    }

    /**
     * Handle the Campus "force deleted" event.
     */
    public function forceDeleted(Campus $campus): void
    {
        //
    }
}
