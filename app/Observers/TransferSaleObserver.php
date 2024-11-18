<?php

namespace App\Observers;

use App\Models\TransferSale;

class TransferSaleObserver
{
    /**
     * Handle the TransferSale "created" event.
     */
    public function created(TransferSale $transferSale): void
    {
        //
    }

    /**
     * Handle the TransferSale "updated" event.
     */
    public function updated(TransferSale $transferSale): void
    {
        //
    }

    /**
     * Handle the TransferSale "deleted" event.
     */
    public function deleted(TransferSale $transferSale): void
    {
        //
    }

    /**
     * Handle the TransferSale "restored" event.
     */
    public function restored(TransferSale $transferSale): void
    {
        //
    }

    /**
     * Handle the TransferSale "force deleted" event.
     */
    public function forceDeleted(TransferSale $transferSale): void
    {
        //
    }
}
