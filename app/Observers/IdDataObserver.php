<?php

namespace App\Observers;

use App\Models\IdData;
use Illuminate\Support\Facades\Storage;

class IdDataObserver
{
    /**
     * Handle the IdData "created" event.
     */
    public function created(IdData $idData): void
    {
        //
    }

    /**
     * Handle the IdData "updated" event.
     */
    public function updated(IdData $idData): void
    {
        //
    }

    /**
     * Handle the IdData "deleted" event.
     */
    public function deleted(IdData $idData): void
    {
        if (!empty($idData->logo)) {

            if (Storage::disk('public')->exists($idData->logo)) {

                Storage::disk('public')->delete($idData->logo);
            }
        }
        if (!empty($idData->bg)) {

            if (Storage::disk('public')->exists($idData->bg)) {

                Storage::disk('public')->delete($idData->bg);
            }
        }
    }

    /**
     * Handle the IdData "restored" event.
     */
    public function restored(IdData $idData): void
    {
        //
    }

    /**
     * Handle the IdData "force deleted" event.
     */
    public function forceDeleted(IdData $idData): void
    {
        //
    }
}
