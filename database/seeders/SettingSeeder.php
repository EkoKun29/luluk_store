<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::query()->create([
            'cash_purchase_code' => 'BC',
            'hutang_purchase_code' => 'BH',
            'transfer_purchase_code' => 'BT',
            'cash_sale_code' => 'JC',
            'piutang_sale_code' => 'JP',
            'transfer_sale_code' => 'JT',
        ]);
    }
}
