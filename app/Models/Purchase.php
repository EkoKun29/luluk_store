<?php

namespace App\Models;

use App\Enums\PurchaseMethod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'note_number',
        'date',
        'supplier',
        'store_name',
        'amount_paid',
        'method'
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount_paid' => 'integer',
        'method' => PurchaseMethod::class
    ];

    protected $appends = [
        'total',
        'formatted_date',
        'debt_paid_off',
    ];

    /**
     * Get all of the purchaseDetails for the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    /**
     * Get all of the debtPayments for the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function debtPayments(): HasMany
    {
        return $this->hasMany(DebtPayment::class);
    }

    /**
     * Get the debtPurchase associated with the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function debtPurchase(): HasOne
    {
        return $this->hasOne(DebtPurchase::class);
    }

    /**
     * Get the transferPurchase associated with the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transferPurchase(): HasOne
    {
        return $this->hasOne(TransferPurchase::class);
    }

    public function formattedDate(): Attribute
    {
        return new Attribute(get: fn () => Carbon::parse($this->date)->isoFormat('dddd, D MMMM Y'));
    }

    public function total(): Attribute
    {
        return new Attribute(get: function () {
            $total = 0;
            foreach ($this->purchaseDetails as $purchaseDetail) {
                $total += $purchaseDetail->amount * $purchaseDetail->price;
            }
            return $total;
        });
    }

    public function debtPaidOff(): Attribute
    {
        return new Attribute(
            get: function(){
                $debtTotal = 0;
                foreach ($this->debtPayments as $key => $debtPayment) {
                    $debtTotal += $debtPayment->amount_paid;
                }
                return $debtTotal;
            }
        );
    }
}
