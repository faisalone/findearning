<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['category_id', 'title', 'slug', 'price', 'quantity', 'description', 'status'];

    public const IMAGES_FOLDER = 'products';

    protected static function booted()
    {
        static::deleting(function ($product) {
            foreach ($product->images ?? [] as $image) {
                Storage::disk('public')->delete(self::IMAGES_FOLDER . '/' . $product->id . '/' . $image->image);
            }
            $product->images()->delete();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Reverted relationship name to 'images'
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function getImagePathsAttribute()
    {
        $productImages = [];
        foreach ($this->images as $image) {
            $productImages[] = [
                'id' => $image->id,
                'url' => Storage::url(self::IMAGES_FOLDER . '/' . $this->id . '/' . $image->image)
            ];
        }

        return $productImages;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getProductCountAttribute()
    {
        return $this->count();
    }

}