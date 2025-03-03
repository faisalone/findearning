<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

trait ProductSorting
{
    /**
     * Apply sorting to any product query based on request parameters
     *
     * @param Builder|Relation $query
     * @return Builder|Relation
     */
    protected function applySorting($query)
    {
        $sort = request()->get('sort', 'latest');
        
        // Direct handling without calling model methods
        switch ($sort) {
            case 'popularity':
                return $this->applySortByPopularity($query);
                
            case 'price-asc':
                return $query->orderBy('price', 'asc');
                
            case 'price-desc':
                return $query->orderBy('price', 'desc');
                
            case 'latest':
            default:
                return $query->latest();
        }
    }
    
    /**
     * Apply popularity sort using the same logic as Product::getTopProducts
     */
    private function applySortByPopularity($query)
    {
        // Get all orders with non-cancelled status
        $orders = Order::where('status', '!=', 'cancelled')->get();
        
        // Track product counts - re-use logic from getTopProducts
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
        
        // If no ordered products found, fall back to latest
        if ($productCounts->isEmpty()) {
            return $query->latest();
        }
        
        // Sort by count (most ordered first)
        $sortedProductCounts = $productCounts->sortDesc();
        
        // Get all product IDs in order of popularity
        $orderedProductIds = $sortedProductCounts->keys()->all();
        
        // If we have ordered products, apply the custom sorting
        if (!empty($orderedProductIds)) {
            return $query->orderByRaw("FIELD(id, " . implode(',', $orderedProductIds) . ") DESC");
        }
        
        // Fallback to latest products
        return $query->latest();
    }
}
