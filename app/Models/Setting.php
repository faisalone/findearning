<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // ...new import...

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'image'];

    /**
     * Get a setting by key.
     * Returns the 'value' if present; if 'value' is null, returns the Storage URL for 'image'.
     * If both are null, returns the default.
     * 
     * @param string|null $key The setting key to retrieve
     * @param mixed $default The default if not found
     * @return mixed
     */
    public static function get($key = null, $default = null)
    {
        if ($key === null) {
            return self::all()
                ->mapWithKeys(function($item){
                    $val = $item->value !== null 
                        ? $item->value 
                        : ($item->image ? url(Storage::url($item->image)) : null);
                    return [$item->key => $val];
                })->all();
        }
        
        $setting = self::where('key', $key)->first();
        if (!$setting) {
            return $default;
        }
        return $setting->value !== null
            ? $setting->value
            : ($setting->image ? url(Storage::url($setting->image)) : $default);
    }

    public static function set($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Initialize common settings keys if they don't exist.
     */
    public static function initializeDefaults()
    {
        $defaultKeys = ['url', 'title', 'description', 'keywords', 'whatsapp', 'telegram', 'email', 'favicon', 'og'];
        foreach ($defaultKeys as $key) {
            self::firstOrCreate(['key' => $key], ['value' => null]);
        }
    }
}
