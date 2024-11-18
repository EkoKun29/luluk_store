<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bank::query()->create([
            'name' => 'BNI'
        ]);
        Bank::query()->create([
            'name' => 'BRI'
        ]);
        Bank::query()->create([
            'name' => 'Mandiri'
        ]);
        Bank::query()->create([
            'name' => 'BSI'
        ]);
    }
}
