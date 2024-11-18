<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivablePayment extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'date',
        'sale_id',
        'amount_paid',
        'method'
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount_paid' => 'integer',
        'method' => PaymentMethod::class
    ];

    /**
     * Get the sale that owns the ReceivablePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the receivablePaymentTransfer associated with the ReceivablePayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receivablePaymentTransfer(): HasOne
    {
        return $this->hasOne(ReceivablePaymentTransfer::class);
    }
    
}
