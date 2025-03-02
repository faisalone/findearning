<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

    /**
     * Get top products based on order frequency
     * 
     * @param int $limit Number of products to return
     * @param bool $fallbackToLatest Whether to fall back to latest products
     * @return Collection
     */
    public static function getTopProducts(int $limit = 5, bool $fallbackToLatest = true): Collection
    {
        // If there are no orders and no fallback is requested, return empty collection
        $orderCount = Order::count();
        if ($orderCount === 0 && !$fallbackToLatest) {
            return collect([]);
        }

        // Get all completed orders
        $orders = Order::where('status', '!=', 'cancelled')->get();
        
        // Track product counts
        $productCounts = collect();
        
        // Process each order
        foreach ($orders as $order) {
            $orderProducts = $order->products();
            
            foreach ($orderProducts as $product) {
                $productId = $product->id;
                $quantity = $product->quantity ?? 1;
                
                $currentCount = $productCounts->get($productId, 0);
                $productCounts->put($productId, $currentCount + $quantity);
            }
        }
        
        // If no ordered products found, handle fallback
        if ($productCounts->isEmpty()) {
            return $fallbackToLatest 
                ? self::active()->latest()->limit($limit)->get() 
                : collect([]);
        }

        // Sort by count (most ordered first)
        $sortedProductCounts = $productCounts->sortDesc();
        
        // Get IDs of top products
        $topProductIds = $sortedProductCounts->keys()->take($limit)->all();
        
        // Fetch the products
        $topProducts = self::whereIn('id', $topProductIds)
            ->active()
            ->get();
            
        // Re-sort them by their count and get values
        $sortedProducts = $topProducts->sortByDesc(function ($product) use ($sortedProductCounts) {
            return $sortedProductCounts->get($product->id, 0);
        })->values();
        
        // Add fallback products if needed
        if ($sortedProducts->count() < $limit && $fallbackToLatest) {
            $additionalProducts = self::active()
                ->whereNotIn('id', $sortedProducts->pluck('id'))
                ->latest()
                ->limit($limit - $sortedProducts->count())
                ->get();
                
            $sortedProducts = $sortedProducts->concat($additionalProducts);
        }
        
        return $sortedProducts;
    }

    /**
     * Scope a query to only include active products
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}