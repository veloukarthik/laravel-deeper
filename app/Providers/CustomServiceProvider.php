<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentServices;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind('App\Services\PaymentServices', function () {
            return new PaymentServices();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
