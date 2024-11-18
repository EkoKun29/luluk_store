<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = Product::query()->create([
            'name' => fake()->word(),
            'unit' => 'kg',
            'stock' => 10
        ]);

        $product1->productPrices()->create([
            'price' => 10000
        ]);

        $product2 = Product::query()->create([
            'name' => fake()->word(),
            'unit' => 'meter',
            'stock' => 20
        ]);

        $product2->productPrices()->create([
            'price' => 20000
        ]);

        $product2->productPrices()->create([
            'price' => 25000
        ]);

        //buat perulangan for untuk membuat data product

        for ($i = 0; $i < 100; $i++) {
            $product = Product::query()->create([
                'name' => fake()->word(),
                'unit' => 'kg',
                'stock' => 10
            ]);

            $product->productPrices()->create([
                'price' => 10000
            ]);
        }
    }
}
