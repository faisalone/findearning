<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            Category::create([
                'title' => 'Category ' . $i,
                'slug' => Str::slug('Category ' . $i),
                'description' => 'Description for Category ' . $i,
                'image' => '67adadc4720b0.jpg',
                // ...any other fields...
            ]);
        }
    }
}
