<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.force_https') || $this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Bind analytics keys from .env to app config for use in blade templates
        config([
            'app.google_analytics_id'    => env('GOOGLE_ANALYTICS_ID'),
            'app.google_site_verification' => env('GOOGLE_SITE_VERIFICATION'),
            'app.microsoft_clarity_id'   => env('MICROSOFT_CLARITY_ID'),
        ]);
    }
}
