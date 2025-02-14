<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $imageFiles = Storage::disk('public')->files('products/' . $product->id);

            foreach ($imageFiles as $file) {
                DB::table('product_images')->insert([
                    'product_id' => $product->id,
                    'image' => basename($file),
                    'alt_text' => 'Image for ' . $product->title,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
