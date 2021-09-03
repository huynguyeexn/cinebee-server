<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
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
            \App\Repositories\SeatStatus\SeatStatusRepositoryInterface::class,
            \App\Repositories\SeatStatus\SeatStatusRepository::class
        );
        $this->app->singleton(
            \App\Repositories\RoomStatus\RoomStatusRepositoryInterface::class,
            \App\Repositories\RoomStatus\RoomStatusRepository::class,
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
        if (App::environment() === "production") {
            URL::forceScheme("https");
        }
    }
}
