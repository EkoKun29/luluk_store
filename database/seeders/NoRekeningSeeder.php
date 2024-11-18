<?php

namespace Database\Seeders;

use App\Models\NoRekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoRekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NoRekening::query()->create([
            'bank_id' => 1,
            'account_number' => '342367598',
            'name' => 'Pemilik'
        ]);
    }
}
