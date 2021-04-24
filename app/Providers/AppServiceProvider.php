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

        $this->app->singleton(
            \App\Services\BannerServiceInterface::class,
            \App\Services\BannerService::class
        );

        $this->app->singleton(
            \App\Services\PartnerServiceInterface::class,
            \App\Services\PartnerService::class
        );

        $this->app->singleton(
            \App\Services\CategoryNewsServiceInterface::class,
            \App\Services\CategoryNewsService::class
        );

        $this->app->singleton(
            \App\Services\AlbumServiceInterface::class,
            \App\Services\AlbumService::class
        );

        $this->app->singleton(
            \App\Services\AlbumImageServiceInterface::class,
            \App\Services\AlbumImageService::class
        );

        $this->app->singleton(
            \App\Services\OrderServiceInterface::class,
            \App\Services\OrderService::class
        );

        $this->app->singleton(
            \App\Services\OrderDetailServiceInterface::class,
            \App\Services\OrderDetailService::class
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
