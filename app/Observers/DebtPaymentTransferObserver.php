<?php

namespace App\Observers;

use App\Models\DebtPaymentTransfer;

class DebtPaymentTransferObserver
{
    /**
     * Handle the DebtPaymentTransfer "created" event.
     */
    public function created(DebtPaymentTransfer $debtPaymentTransfer): void
    {
        //
    }

    /**
     * Handle the DebtPaymentTransfer "updated" event.
     */
    public function updated(DebtPaymentTransfer $debtPaymentTransfer): void
    {
        //
    }

    /**
     * Handle the DebtPaymentTransfer "deleted" event.
     */
    public function deleted(DebtPaymentTransfer $debtPaymentTransfer): void
    {
        //
    }

    /**
     * Handle the DebtPaymentTransfer "restored" event.
     */
    public function restored(DebtPaymentTransfer $debtPaymentTransfer): void
    {
        //
    }

    /**
     * Handle the DebtPaymentTransfer "force deleted" event.
     */
    public function forceDeleted(DebtPaymentTransfer $debtPaymentTransfer): void
    {
        //
    }
}
