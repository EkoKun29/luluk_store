<?php

namespace App\Observers;

use App\Models\CashDeposit;

class CashDepositObserver
{
    /**
     * Handle the CashDeposit "created" event.
     */
    public function created(CashDeposit $cashDeposit): void
    {
        //
    }

    /**
     * Handle the CashDeposit "updated" event.
     */
    public function updated(CashDeposit $cashDeposit): void
    {
        //
    }

    /**
     * Handle the CashDeposit "deleted" event.
     */
    public function deleted(CashDeposit $cashDeposit): void
    {
        //
    }

    /**
     * Handle the CashDeposit "restored" event.
     */
    public function restored(CashDeposit $cashDeposit): void
    {
        //
    }

    /**
     * Handle the CashDeposit "force deleted" event.
     */
    public function forceDeleted(CashDeposit $cashDeposit): void
    {
        //
    }
}
