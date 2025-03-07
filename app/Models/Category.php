<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
	use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['title', 'slug', 'description', 'image', 'status', 'order'];

    public const IMAGE_FOLDER = 'categories';

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

	private function getImageUrl($imageName)
	{
		return Storage::url(self::IMAGE_FOLDER . '/' . $imageName);
	}

	public function getImagePathAttribute()
	{
		return $this->getImageUrl($this->image);
	}

    public static function getTopCategories($limit = null)
    {
        $query = self::where('status', true);

        if ($limit) {
            $query->limit($limit);
        }

        $categories = $query->get();

        if ($categories->isEmpty()) {
            return collect([]);
        }

        $categoryCounts = $categories->mapWithKeys(fn($cat) => [$cat->id => 0]);

        // Fetch all non-cancelled orders
        $orders = Order::where('status', '!=', 'cancelled')->get();

        foreach ($orders as $order) {
            $orderProducts = $order->products();
            foreach ($orderProducts as $product) {
                if ($product->category_id && isset($categoryCounts[$product->category_id])) {
                    $categoryCounts[$product->category_id] += ($product->quantity ?? 1);
                }
            }
        }

        // Sort categories by their counts
        return $categories->sortByDesc(fn($cat) => $categoryCounts[$cat->id])->values();
    }

	// public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}