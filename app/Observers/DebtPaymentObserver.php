<?php

namespace App\Observers;

use App\Models\DebtPayment;

class DebtPaymentObserver
{
    /**
     * Handle the DebtPayment "created" event.
     */
    public function created(DebtPayment $debtPayment): void
    {
        //
    }

    /**
     * Handle the DebtPayment "updated" event.
     */
    public function updated(DebtPayment $debtPayment): void
    {
        //
    }

    /**
     * Handle the DebtPayment "deleted" event.
     */
    public function deleted(DebtPayment $debtPayment): void
    {
        //
    }

    /**
     * Handle the DebtPayment "restored" event.
     */
    public function restored(DebtPayment $debtPayment): void
    {
        //
    }

    /**
     * Handle the DebtPayment "force deleted" event.
     */
    public function forceDeleted(DebtPayment $debtPayment): void
    {
        //
    }
}
