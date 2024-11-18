<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'cash_purchase_code',
        'hutang_purchase_code',
        'transfer_purchase_code',
        'cash_sale_code',
        'piutang_sale_code',
        'transfer_sale_code'
    ];
}
