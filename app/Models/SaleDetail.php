<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'sale_id',
        'product_price_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'double',
    ];

    /**
     * Get the sale that owns the SaleDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the productPrice that owns the SaleDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productPrice(): BelongsTo
    {
        return $this->belongsTo(ProductPrice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product that owns the SaleDetail
     *
     * return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function product(): BelongsTo
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
