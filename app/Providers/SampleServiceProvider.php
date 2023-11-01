<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SampleService;
class SampleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        {
            $this->app->bind('square', function ($app) {
                return new SampleService();
            });
        }
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
