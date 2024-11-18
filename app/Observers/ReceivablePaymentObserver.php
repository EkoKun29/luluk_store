<?php

namespace App\Observers;

use App\Models\ReceivablePayment;

class ReceivablePaymentObserver
{
    /**
     * Handle the ReceivablePayment "created" event.
     */
    public function created(ReceivablePayment $receivablePayment): void
    {
        //
    }

    /**
     * Handle the ReceivablePayment "updated" event.
     */
    public function updated(ReceivablePayment $receivablePayment): void
    {
        //
    }

    /**
     * Handle the ReceivablePayment "deleted" event.
     */
    public function deleted(ReceivablePayment $receivablePayment): void
    {
        //
    }

    /**
     * Handle the ReceivablePayment "restored" event.
     */
    public function restored(ReceivablePayment $receivablePayment): void
    {
        //
    }

    /**
     * Handle the ReceivablePayment "force deleted" event.
     */
    public function forceDeleted(ReceivablePayment $receivablePayment): void
    {
        //
    }
}
