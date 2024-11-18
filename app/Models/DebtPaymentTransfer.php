<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DebtPaymentTransfer extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'debt_payment_id',
        'no_rekening_id'
    ];

    protected $casts = [

    ];

    /**
     * Get the debtPayment that owns the DebtPaymentTransfer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function debtPayment(): BelongsTo
    {
        return $this->belongsTo(DebtPayment::class);
    }

    /**
     * Get the noRekening that owns the DebtPaymentTransfer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function noRekening(): BelongsTo
    {
        return $this->belongsTo(NoRekening::class);
    }
}
