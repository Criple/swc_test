<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use App\Repositories\ResourceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(ResourceRepositoryInterface::class, ResourceRepository::class);
        $this->app->singleton(BookingRepositoryInterface::class, BookingRepository::class);
    }

}
