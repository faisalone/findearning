<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class Settings
{
    /**
     * Get a setting value
     *
     * @param string|null $key Setting key
     * @param mixed $default Default value if setting doesn't exist
     * @return mixed
     */
    public static function get($key = null, $default = null)
    {
        if ($key === null) {
            return Config::get('settings', []);
        }

        return Config::get('settings.' . $key, $default);
    }

    /**
     * Check if a setting exists
     *
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return Config::has('settings.' . $key);
    }
}
