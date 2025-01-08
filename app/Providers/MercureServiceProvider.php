<?php

namespace App\Providers;

use App\Services\MercureService;
use Illuminate\Support\ServiceProvider;

class MercureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MercureService::class, function ($app) {
            return new MercureService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
