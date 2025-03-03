<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PaymentMethod extends Model
{
	public const IMAGE_FOLDER = 'payment-methods';

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'rate',
		'address',
		'instruction',
		'image',
		'qr',
		'status',
	];

    // Append computed attributes so that they are available in JSON
    protected $appends = ['image_path', 'qr_path'];

	public function getImagePathAttribute()
    {
        return Storage::url(self::IMAGE_FOLDER . '/' . $this->image);
    }
    
    public function getQrPathAttribute()
    {
        return Storage::url(self::IMAGE_FOLDER . '/' . $this->qr);
    }

	/**
	 * The attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'status' => 'boolean',
		];
	}
}
