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
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Director\DirectorRepositoryInterface::class,
            \App\Repositories\Director\DirectorRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Employee\EmployeeRepositoryInterface::class,
            \App\Repositories\Employee\EmployeeRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\AgeRating\AgeRatingRepositoryInterface::class,
            \App\Repositories\AgeRating\AgeRatingRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Movie\MovieRepositoryInterface::class,
            \App\Repositories\Movie\MovieRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\MovieDirector\MovieDirectorRepositoryInterface::class,
            \App\Repositories\MovieDirector\MovieDirectorRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\MovieGenre\MovieGenreRepositoryInterface::class,
            \App\Repositories\MovieGenre\MovieGenreRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\MovieActor\MovieActorRepositoryInterface::class,
            \App\Repositories\MovieActor\MovieActorRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\CustomerType\CustomerTypeRepositoryInterface::class,
            \App\Repositories\CustomerType\CustomerTypeRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Customer\CustomerRepositoryInterface::class,
            \App\Repositories\Customer\CustomerRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Combo\ComboRepositoryInterface::class,
            \App\Repositories\Combo\ComboRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\ComboTicket\ComboTicketRepositoryInterface::class,
            \App\Repositories\ComboTicket\ComboTicketRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\ComboItem\ComboItemRepositoryInterface::class,
            \App\Repositories\ComboItem\ComboItemRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\MovieTicket\MovieTicketRepositoryInterface::class,
            \App\Repositories\MovieTicket\MovieTicketRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Blog\BlogRepositoryInterface::class,
            \App\Repositories\Blog\BlogRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Showtime\ShowtimeRepositoryInterface::class,
            \App\Repositories\Showtime\ShowtimeRepository::class,
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
