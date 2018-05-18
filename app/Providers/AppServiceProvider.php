<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\UserRepositoryInterface;

use App\Repositories\Eloquent\UserRepository;

use App\Repositories\Contracts\BusRepositoryInterface;

use App\Repositories\Eloquent\BusRepository;

use App\Repositories\Contracts\StationRepositoryInterface;

use App\Repositories\Eloquent\StationRepository;

use App\Repositories\Contracts\BusTypeRepositoryInterface;

use App\Repositories\Eloquent\BusTypeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BusRepositoryInterface::class, BusRepository::class);
        $this->app->bind(StationRepositoryInterface::class, StationRepository::class);
        $this->app->bind(BusTypeRepositoryInterface::class, BusTypeRepository::class);
    }
}
