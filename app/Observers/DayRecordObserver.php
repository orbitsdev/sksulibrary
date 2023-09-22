<?php

namespace App\Observers;

use App\Models\DayRecord;

class DayRecordObserver
{
    /**
     * Handle the DayRecord "created" event.
     */
    public function created(DayRecord $dayRecord): void
    {
        //
    }

    /**
     * Handle the DayRecord "updated" event.
     */
    public function updated(DayRecord $dayRecord): void
    {
        //
    }

    /**
     * Handle the DayRecord "deleted" event.
     */
    public function deleted(DayRecord $dayRecord): void
    {
        

        $dayRecord->daylogins->each(function ($login) {
          
            // Delete the login record
            $login->delete();
        });
    }

    /**
     * Handle the DayRecord "restored" event.
     */
    public function restored(DayRecord $dayRecord): void
    {
        //
    }

    /**
     * Handle the DayRecord "force deleted" event.
     */
    public function forceDeleted(DayRecord $dayRecord): void
    {
        //
    }
}
