<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferPurchase extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'purchase_id',
        'no_rekening_id',
    ];

    protected $casts = [

    ];

    /**
     * Get the purchase that owns the TransferPurchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Get the noRekening that owns the TransferPurchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function noRekening(): BelongsTo
    {
        return $this->belongsTo(NoRekening::class);
    }
}
