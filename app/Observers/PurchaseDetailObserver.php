<?php

namespace App\Observers;

use App\Models\PurchaseDetail;

class PurchaseDetailObserver
{
    /**
     * Handle the PurchaseDetail "created" event.
     */
    public function created(PurchaseDetail $purchaseDetail): void
    {
        //
    }

    /**
     * Handle the PurchaseDetail "updated" event.
     */
    public function updated(PurchaseDetail $purchaseDetail): void
    {
        //
    }

    /**
     * Handle the PurchaseDetail "deleted" event.
     */
    public function deleted(PurchaseDetail $purchaseDetail): void
    {
        //
    }

    /**
     * Handle the PurchaseDetail "restored" event.
     */
    public function restored(PurchaseDetail $purchaseDetail): void
    {
        //
    }

    /**
     * Handle the PurchaseDetail "force deleted" event.
     */
    public function forceDeleted(PurchaseDetail $purchaseDetail): void
    {
        //
    }
}
