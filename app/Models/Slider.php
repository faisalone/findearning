<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $fillable = ['title', 'image'];

    public const IMAGE_FOLDER = 'sliders';

    public function getImagePathAttribute()
    {
        return Storage::url(self::IMAGE_FOLDER . '/' . $this->image);
    }
}