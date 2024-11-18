<?php

namespace App\Observers;

use App\Enums\PurchaseMethod;
use App\Models\Purchase;
use App\Models\Setting;
use Illuminate\Support\Str;

class PurchaseObserver
{
    /**
     * Handle the Purchase "saving" event
     */
    public function saving(Purchase $purchase): void
    {

    }

    /**
     * Handle the Purchase "created" event.
     */
    public function created(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "updated" event.
     */
    public function updated(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "deleted" event.
     */
    public function deleted(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "restored" event.
     */
    public function restored(Purchase $purchase): void
    {
        //
    }

    /**
     * Handle the Purchase "force deleted" event.
     */
    public function forceDeleted(Purchase $purchase): void
    {
        //
    }
}
