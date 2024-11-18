<?php

namespace App\Observers;

use App\Models\ReceivablePaymentTransfer;

class ReceivablePaymentTransferObserver
{
    /**
     * Handle the ReceivablePaymentTransfer "created" event.
     */
    public function created(ReceivablePaymentTransfer $receivablePaymentTransfer): void
    {
        //
    }

    /**
     * Handle the ReceivablePaymentTransfer "updated" event.
     */
    public function updated(ReceivablePaymentTransfer $receivablePaymentTransfer): void
    {
        //
    }

    /**
     * Handle the ReceivablePaymentTransfer "deleted" event.
     */
    public function deleted(ReceivablePaymentTransfer $receivablePaymentTransfer): void
    {
        //
    }

    /**
     * Handle the ReceivablePaymentTransfer "restored" event.
     */
    public function restored(ReceivablePaymentTransfer $receivablePaymentTransfer): void
    {
        //
    }

    /**
     * Handle the ReceivablePaymentTransfer "force deleted" event.
     */
    public function forceDeleted(ReceivablePaymentTransfer $receivablePaymentTransfer): void
    {
        //
    }
}
