<?php

namespace App\Providers;

use App\Models\Booking;
use App\Observers\BookingObserver;
use App\Services\Booking\BookingsService;
use App\Services\Booking\Interfaces\BookingsServiceInterface;
use App\Services\Resource\Interfaces\ResourcesServiceInterface;
use App\Services\Resource\ResourcesService;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Booking::observe(BookingObserver::class);
        $this->app->bind(ResourcesServiceInterface::class, ResourcesService::class);
        $this->app->bind(BookingsServiceInterface::class, BookingsService::class);
    }
}
