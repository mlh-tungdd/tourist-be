<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Services\UserServiceInterface::class,
            \App\Services\UserService::class
        );

        $this->app->singleton(
            \App\Services\TimeServiceInterface::class,
            \App\Services\TimeService::class
        );

        $this->app->singleton(
            \App\Services\LocationServiceInterface::class,
            \App\Services\LocationService::class
        );

        $this->app->singleton(
            \App\Services\TourServiceInterface::class,
            \App\Services\TourService::class
        );

        $this->app->singleton(
            \App\Services\TourDepartureServiceInterface::class,
            \App\Services\TourDepartureService::class
        );

        $this->app->singleton(
            \App\Services\TourPriceServiceInterface::class,
            \App\Services\TourPriceService::class
        );

        $this->app->singleton(
            \App\Services\TourScheduleServiceInterface::class,
            \App\Services\TourScheduleService::class
        );

        $this->app->singleton(
            \App\Services\TourImageServiceInterface::class,
            \App\Services\TourImageService::class
        );

        $this->app->singleton(
            \App\Services\NewsServiceInterface::class,
            \App\Services\NewsService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
