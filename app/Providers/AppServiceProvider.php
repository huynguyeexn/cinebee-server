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
            \App\Repositories\RoomStatus\RoomStatusRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Room\RoomRepositoryInterface::class,
            \App\Repositories\Room\RoomRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Seat\SeatRepositoryInterface::class,
            \App\Repositories\Seat\SeatRepository::class
        );
        // long add 06-09-2021
        $this->app->singleton(
            \App\Repositories\Actor\ActorRepositoryInterface::class,
            \App\Repositories\Actor\ActorRepository::class
        );
        // long add 06-09-2021
        $this->app->singleton(
            \App\Repositories\Genre\GenreRepositoryInterface::class,
            \App\Repositories\Genre\GenreRepository::class
        );
        $this->app->singleton(
            \App\Repositories\EmployeeRole\EmployeeRoleRepositoryInterface::class,
            \App\Repositories\EmployeeRole\EmployeeRoleRepository::class,
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
