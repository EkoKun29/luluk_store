<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoRekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'name',
        'account_number'
    ];

    protected $casts = [
        'bank_id' => 'integer'
    ];

    /**
     * Get the bank that owns the NoRekening
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
