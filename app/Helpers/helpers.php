<?php
use App\Models\Setting;

if (! function_exists('getSetting')) {
    function getSetting($key, $default = null) {
        $setting = Setting::where('key', $key)->first(); // Adjusted for renamed function
        return $setting ? $setting->value : $default;
    }
}