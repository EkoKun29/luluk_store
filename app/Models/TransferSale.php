<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferSale extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'sale_id',
        'sales',
        'brought_by',
        'no_rekening_id',
    ];

    protected $casts = [
        'no_rekening_id' => 'integer'
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

    /**
     * Get the noRekening that owns the TransferSale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function noRekening(): BelongsTo
    {
        return $this->belongsTo(NoRekening::class);
    }
}
