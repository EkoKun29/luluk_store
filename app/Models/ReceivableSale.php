<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivableSale extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'sale_id',
        'brought_by',
    ];

    protected $casts = [
    ];

    /**
     * Get the sale that owns the ReceivableSale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
