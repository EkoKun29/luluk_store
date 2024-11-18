<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DebtPayment extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'date',
        'purchase_id',
        'amount_paid',
        'method'
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount_paid' => 'integer',
        'method' => PaymentMethod::class
    ];

    /**
     * Get the purchase that owns the DebtPayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Get the debtPaymentTransfer associated with the DebtPayment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function debtPaymentTransfer(): HasOne
    {
        return $this->hasOne(DebtPaymentTransfer::class);
    }
}
