<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the noRekenings for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function noRekenings(): HasMany
    {
        return $this->hasMany(NoRekening::class);
    }
}
