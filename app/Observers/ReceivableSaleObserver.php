<?php

namespace App\Observers;

use App\Models\ReceivableSale;

class ReceivableSaleObserver
{
    /**
     * Handle the ReceivableSale "created" event.
     */
    public function created(ReceivableSale $receivableSale): void
    {
        //
    }

    /**
     * Handle the ReceivableSale "updated" event.
     */
    public function updated(ReceivableSale $receivableSale): void
    {
        //
    }

    /**
     * Handle the ReceivableSale "deleted" event.
     */
    public function deleted(ReceivableSale $receivableSale): void
    {
        //
    }

    /**
     * Handle the ReceivableSale "restored" event.
     */
    public function restored(ReceivableSale $receivableSale): void
    {
        //
    }

    /**
     * Handle the ReceivableSale "force deleted" event.
     */
    public function forceDeleted(ReceivableSale $receivableSale): void
    {
        //
    }
}
