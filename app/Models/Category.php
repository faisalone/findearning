<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
	use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['title', 'slug', 'description', 'image'];

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

	// public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}