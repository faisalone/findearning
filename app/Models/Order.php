<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Illuminate\Support\Collection;

class Order extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'user_id',
        'product_details', // Rename to product_details
        'delivery_method',
        'payment_option',
        'proof',
        'total',
        'order_notes',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'product_details' => 'array'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get products from the order's product_details JSON field
     * 
     * @return Collection
     */
    public function products(): Collection
    {
        try {
            // Quick exit if no product details
            if (empty($this->product_details)) {
                return collect([]);
            }

            // Parse product details with error handling
            $details = json_decode($this->product_details, true) ?? [];
            
            // Extract product IDs with array filtering for safety
            $productIds = collect($details)
                ->filter(fn($item) => isset($item['id']))
                ->pluck('id')
                ->unique();
                
            if ($productIds->isEmpty()) {
                return collect([]);
            }

            // Create a quantities lookup
            $quantities = collect($details)
                ->filter(fn($item) => isset($item['id']))
                ->mapWithKeys(fn($item) => [$item['id'] => $item['quantity'] ?? 1]);

            // Fetch and enhance products with their quantities
            return Product::whereIn('id', $productIds)
                ->get()
                ->map(function($product) use ($quantities) {
                    $product->quantity = $quantities[$product->id] ?? 1;
                    return $product;
                });
                
        } catch (\Throwable $e) {
            report($e);
            return collect([]);
        }
    }

    // Get the URL of the proof image
    public function proofUrl()
    {
        return Storage::url('proofs/' . $this->proof);
    }
}
