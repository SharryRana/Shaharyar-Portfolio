<?php

use Modules\Blog\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

if (!function_exists('setting')) {
    /**
     * Get a setting by key from the database.
     * Uses cache to avoid redundant database hits.
     */
    function setting($key, $default = null)
    {
        // Pluck all settings if not already cached to optimize
        // Store as array to avoid "Incomplete Object" serialization errors
        $settings = Cache::rememberForever('site_settings', function () {
            if (!Schema::hasTable('settings')) {
                return [];
            }

            return Setting::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('recordActivity')) {
    /**
     * Record an activity in the database.
     */
    function recordActivity($description, $type = 'info')
    {
        try {
            \Modules\Blog\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'description' => $description,
                'type' => $type,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Activity Log Error: ' . $e->getMessage());
        }
    }
}
