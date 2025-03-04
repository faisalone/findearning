<?php

if (!function_exists('setting')) {
    /**
     * Get a setting value by key
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key = null, $default = null)
    {
        if ($key === null) {
            return app('settings');
        }
        
        return app('settings')[$key] ?? $default;
    }
}
