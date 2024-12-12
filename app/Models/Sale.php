<?php

namespace App\Models;

use App\Enums\SaleMethod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'note_number',
        'date',
        'consumer',
        'store_name',
        'amount_paid',
        'method',
        'id_user',
        'nama_user',
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount_paid' => 'integer',
        'method' => SaleMethod::class
    ];

    protected $appends = [
        'total',
        'formatted_date',
        'receivable_paid_off',
    ];

    /**
     * Get all of the purchaseDetails for the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    /**
     * Get all of the debtPayments for the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivablePayments(): HasMany
    {
        return $this->hasMany(ReceivablePayment::class);
    }

    /**
     * Get the receivableSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receivableSale(): HasOne
    {
        return $this->hasOne(ReceivableSale::class);
    }

    /**
     * Get the transferSale associated with the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transferSale(): HasOne
    {
        return $this->hasOne(TransferSale::class);
    }

    public function formattedDate(): Attribute
    {
        return new Attribute(get: fn () => Carbon::parse($this->date)->isoFormat('dddd, D MMMM Y'));
    }

    public function total(): Attribute
    {
        return new Attribute(get: function () {
            $total = 0;
            foreach ($this->saleDetails as $saleDetail) {
                $total += $saleDetail->amount * $saleDetail->productPrice->price;
            }
            return $total;
        });
    }

    public function receivablePaidOff(): Attribute
    {
        return new Attribute(
            get: function(){
                $receivableTotal = 0;
                foreach ($this->receivablePayments as $key => $receivablePayment) {
                    $receivableTotal += $receivablePayment->amount_paid;
                }
                return $receivableTotal;
            }
        );
    }
}
