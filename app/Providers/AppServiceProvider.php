<?php

namespace App\Providers;

use App\Clients\Contracts\SafeUrlCheckContract;
use App\Clients\GoogleSafeSearchClient;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(
            SafeUrlCheckContract::class,
            GoogleSafeSearchClient::class
        );
    }
}
