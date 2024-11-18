<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceivablePaymentTransfer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'receivable_payment_id',
        'no_rekening_id',
    ];

    protected $casts = [

    ];

    /**
     * Get the receivablePayment that owns the ReceivablePaymentTransfer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receivablePayment(): BelongsTo
    {
        return $this->belongsTo(ReceivablePayment::class);
    }

    /**
     * Get the noRekening that owns the ReceivablePaymentTransfer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function noRekening(): BelongsTo
    {
        return $this->belongsTo(NoRekening::class);
    }
}
