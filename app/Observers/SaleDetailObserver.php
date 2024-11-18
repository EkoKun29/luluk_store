<?php

namespace App\Observers;

use App\Models\SaleDetail;

class SaleDetailObserver
{
    /**
     * Handle the SaleDetail "created" event.
     */
    public function created(SaleDetail $saleDetail): void
    {
        //
    }

    /**
     * Handle the SaleDetail "updated" event.
     */
    public function updated(SaleDetail $saleDetail): void
    {
        //
    }

    /**
     * Handle the SaleDetail "deleted" event.
     */
    public function deleted(SaleDetail $saleDetail): void
    {
        //
    }

    /**
     * Handle the SaleDetail "restored" event.
     */
    public function restored(SaleDetail $saleDetail): void
    {
        //
    }

    /**
     * Handle the SaleDetail "force deleted" event.
     */
    public function forceDeleted(SaleDetail $saleDetail): void
    {
        //
    }
}
