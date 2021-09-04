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
            \App\Repositories\SeatStatus\SeatStatusRepositoryInterface::class,
            \App\Repositories\SeatStatus\SeatStatusRepository::class
        );
        $this->app->singleton(
            \App\Repositories\RoomStatus\RoomStatusRepositoryInterface::class,
            \App\Repositories\RoomStatus\RoomStatusRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Room\RoomRepositoryInterface::class,
            \App\Repositories\Room\RoomRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Seat\SeatRepositoryInterface::class,
            \App\Repositories\Seat\SeatRepository::class,
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
