<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'stock',
        'unit'
    ];

    protected $casts = [];

    protected $appends = [
        'current_stock'
    ];

    /**
     * Get all of the productPrices for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPrices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }

    /**
     * Get the productPrice associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productPrice(): HasOne
    {
        return $this
            ->hasOne(ProductPrice::class)
            ->latestOfMany();
    }

    /**
     * Get all of the purchases for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasesDetails(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    /**
     * Get all of the audits for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audits(): HasMany
    {
        return $this->hasMany(Audit::class);
    }

    public function currentStock(): Attribute
    {
        return new Attribute(
            get: function () {
                $stock = $this->stock;
                foreach ($this->purchasesDetails as $purchaseDetail) {
                    $stock += $purchaseDetail->amount;
                }
                foreach ($this->productPrices as $productPrice) {
                    foreach ($productPrice->saleDetails as $saleDetail) {
                        $stock -= $saleDetail->amount;
                    }
                }
                return $stock;
            }
        );
    }
}
