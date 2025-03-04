<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key
     * 
     * @param string|null $key The setting key to retrieve
     * @param mixed $default The default value if setting doesn't exist
     * @return mixed The setting value or all settings if no key provided
     */
    public static function get($key = null, $default = null)
    {
        // If no key is provided, return all settings as key-value pairs
        if ($key === null) {
            return self::pluck('value', 'key')->all();
        }
        
        return self::where('key', $key)->value('value') ?? $default;
    }

    public static function set($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
