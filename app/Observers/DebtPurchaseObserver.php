<?php

namespace App\Observers;

use App\Models\DebtPurchase;

class DebtPurchaseObserver
{
    /**
     * Handle the DebtPurchase "created" event.
     */
    public function created(DebtPurchase $debtPurchase): void
    {
        //
    }

    /**
     * Handle the DebtPurchase "updated" event.
     */
    public function updated(DebtPurchase $debtPurchase): void
    {
        //
    }

    /**
     * Handle the DebtPurchase "deleted" event.
     */
    public function deleted(DebtPurchase $debtPurchase): void
    {
        //
    }

    /**
     * Handle the DebtPurchase "restored" event.
     */
    public function restored(DebtPurchase $debtPurchase): void
    {
        //
    }

    /**
     * Handle the DebtPurchase "force deleted" event.
     */
    public function forceDeleted(DebtPurchase $debtPurchase): void
    {
        //
    }
}
