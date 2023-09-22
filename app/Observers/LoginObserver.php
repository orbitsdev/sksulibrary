<?php

namespace App\Observers;

use App\Models\DayLogin;

class LoginObserver
{
    /**
     * Handle the DayLogin "created" event.
     */
    public function created(DayLogin $dayLogin): void
    {
        //
    }

    /**
     * Handle the DayLogin "updated" event.
     */
    public function updated(DayLogin $dayLogin): void
    {
        //
    }

    /**
     * Handle the DayLogin "deleted" event.
     */
    public function deleted(DayLogin $dayLogin): void
    {
        $dayLogin->logout()->delete();
    }

    /**
     * Handle the DayLogin "restored" event.
     */
    public function restored(DayLogin $dayLogin): void
    {
        //
    }

    /**
     * Handle the DayLogin "force deleted" event.
     */
    public function forceDeleted(DayLogin $dayLogin): void
    {
        //
    }
}
