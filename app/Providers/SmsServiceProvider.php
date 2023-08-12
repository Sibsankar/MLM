<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Service\SmsServiceInterface', 'App\Service\SmsService');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
