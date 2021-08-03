<?php

namespace App\Providers;

use App\Repositories\DeviceRepositories;
use App\Repositories\Contracts\DeviceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // BIND TO SERVICE CONTAINER
        $this->app->bind(
            DeviceRepositoryInterface::class,
            DeviceRepositories::class
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
