<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductPrice extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'price',
    ];

    protected $casts = [
        'price' => 'integer'
    ];

    protected $appends = [
        'local_created_at'
    ];

    /**
     * Get the product that owns the ProductPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all of the saleDetails for the ProductPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function localCreatedAt(): Attribute
    {
        return new Attribute(
            get: fn() => $this->created_at->isoFormat('dddd, D MMMM Y - HH:mm:ss')
        );
    }
}
