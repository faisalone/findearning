<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            Product::create([
                'category_id' => rand(1, 20),
                'title'       => 'Product ' . $i,
                'slug'        => Str::slug('Product ' . $i . '-' . uniqid()),
                'description' => 'Description for Product ' . $i,
                'price'       => rand(100, 1000) / 10,  // price between 10.00 - 100.00
                'quantity'    => rand(1, 50),
                'status'      => rand(0, 1),
                // ...any other fields...
            ]);
        }
    }
}
