<?php

namespace App\Observers;

use App\Models\TransferPurchase;

class TransferPurchaseObserver
{
    /**
     * Handle the TransferPurchase "created" event.
     */
    public function created(TransferPurchase $transferPurchase): void
    {
        //
    }

    /**
     * Handle the TransferPurchase "updated" event.
     */
    public function updated(TransferPurchase $transferPurchase): void
    {
        //
    }

    /**
     * Handle the TransferPurchase "deleted" event.
     */
    public function deleted(TransferPurchase $transferPurchase): void
    {
        //
    }

    /**
     * Handle the TransferPurchase "restored" event.
     */
    public function restored(TransferPurchase $transferPurchase): void
    {
        //
    }

    /**
     * Handle the TransferPurchase "force deleted" event.
     */
    public function forceDeleted(TransferPurchase $transferPurchase): void
    {
        //
    }
}
