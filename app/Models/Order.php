<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

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

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Product model using the product_details JSON field
    public function products()
    {
        $productDetails = json_decode($this->product_details, true);
        $products = Product::whereIn('id', array_column($productDetails, 'id'))->get();

        // Attach quantities to the products
        foreach ($products as $product) {
            $product->quantity = collect($productDetails)->firstWhere('id', $product->id)['quantity'];
        }

        return $products;
    }

    // Get the URL of the proof image
    public function proofUrl()
    {
        return Storage::url('proofs/' . $this->proof);
    }
}
