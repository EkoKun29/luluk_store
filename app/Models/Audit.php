<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Audit extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'date',
        'product_id',
        'amount',
        'number_of_audit',
        'status'
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'integer',
        'number_of_audit' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Get the product that owns the Audit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
