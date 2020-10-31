<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Support\ApiResponseFactory\ResponseFactoryInterface;
use Support\ApiResponseFactory\ResponseFactoryV1;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Passport::routes();

        $this->app->bind(ResponseFactoryInterface::class, ResponseFactoryV1::class);
    }
}
