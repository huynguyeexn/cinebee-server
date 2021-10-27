<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeRoleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SeatStatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\AgeRatingController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\ComboItemController;
use App\Http\Controllers\ComboTicketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieDirectorController;
use App\Http\Controllers\MovieGenreController;
use App\Http\Controllers\Admin\AuthStaffController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShowtimeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('accounts')->group(function () {
    // admin
    Route::group(['middleware' => ['assign.guard:admin']], function () {
        // login admin
        Route::group(['prefix' => 'admin'], function () {
            Route::post('login', [AuthAdminController::class, 'login']);
            Route::post('register', [AuthAdminController::class, 'register']);
        });
        // login staff
        Route::group(['prefix' => 'staff'], function () {
            Route::post('login', [AuthStaffController::class, 'login']);
            Route::post('register', [AuthStaffController::class, 'register']);
            // profile admin, staff
            Route::middleware(['check.login'])->group(function () {
                Route::get('me', [AuthAdminController::class, 'profile']);
                Route::get('logout', [AuthAdminController::class, 'logout']);
            });
        });
    });
    // client
    // Route::group(['middleware' => ['assign.guard:api']],function ()
    // {
    // 	Route::post('login_user', [AuthController::class, 'login_user']);
    //     Route::post('register_user', [AuthController::class, 'register_user']);
    // });
});

/**
 * REST API - actor
 *  long add 06-09-2021
 */
Route::group(['middleware' => ['assign.guard:admin', 'check.login']], function () {
    Route::prefix('actors')->group(function () {
        Route::get('/', [ActorController::class, 'index']);

        // Get deleted list
        Route::get('/deleted', [ActorController::class, 'deleted']);

        // Create new
        Route::post('/', [ActorController::class, 'store']);

        // Get by ID
        Route::get('/{id}', [ActorController::class, 'getById'])->whereNumber('id');

        // Get by slug
        Route::get('/{slug}', [ActorController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

        // Get Movie of actor
        Route::get('/{id}/movies', [ActorController::class, 'movies'])->whereNumber('id');

        // Update
        Route::put('/{id}', [ActorController::class, 'update'])->whereNumber('id');

        // Soft Delete
        Route::delete('{id}/delete/', [ActorController::class, 'delete'])->whereNumber('id');

        // Hard Delete
        Route::delete('{id}/remove/', [ActorController::class, 'remove'])->whereNumber('id');

        // Restore
        Route::patch('{id}/restore/', [ActorController::class, 'restore'])->whereNumber('id');
        // tạm thời comment lại
        // Route::get('/', [ActorController::class, 'index'])->middleware('checkRole:list-actors');

        // // Get deleted list
        // Route::get('/deleted', [ActorController::class, 'deleted'])->middleware('checkRole:list-actors');

        // // Create new
        // Route::post('/', [ActorController::class, 'store'])->middleware('checkRole:add-actors');

        // // Get by ID
        // Route::get('/{id}', [ActorController::class, 'getById'])->whereNumber('id')->middleware('checkRole:edit-actors');

        // // Get by slug
        // Route::get('/{slug}', [ActorController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$'])->middleware('checkRole:edit-actors');

        // // Get Movie of actor
        // Route::get('/{id}/movies', [ActorController::class, 'movies'])->whereNumber('id');

        // // Update
        // Route::put('/{id}', [ActorController::class, 'update'])->whereNumber('id')->middleware('checkRole:update-actors');

        // // Soft Delete
        // Route::delete('{id}/delete/', [ActorController::class, 'delete'])->whereNumber('id')->middleware('checkRole:delete-actors');

        // // Hard Delete
        // Route::delete('{id}/remove/', [ActorController::class, 'remove'])->whereNumber('id')->middleware('checkRole:delete-actors');

        // // Restore
        // Route::patch('{id}/restore/', [ActorController::class, 'restore'])->whereNumber('id')->middleware('checkRole:delete-actors');
    });
});
/**
 * REST API - genre
 *  long add 06-09-2021
 */
Route::prefix('genres')->group(function () {
    Route::get('/', [GenreController::class, 'index']);
    // Get deleted list
    Route::get('/deleted', [GenreController::class, 'deleted']);

    // Create new
    Route::post('/', [GenreController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [GenreController::class, 'getById'])->whereNumber('id');

    // Get by slug
    Route::get('/{slug}', [GenreController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Get Movie of genre
    Route::get('/{id}/movies', [GenreController::class, 'movies'])->whereNumber('id');

    // Update
    Route::put('/{id}', [GenreController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [GenreController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [GenreController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [GenreController::class, 'restore'])->whereNumber('id');
});
/**
 * REST API - Seat Status
 *
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('seat-status')->group(function () {

    // Get list
    Route::get('/', [SeatStatusController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [SeatStatusController::class, 'deleted']);

    // Create new
    Route::post('/', [SeatStatusController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [SeatStatusController::class, 'getById'])->whereNumber('id');

    // Get by slug
    Route::get('/{slug}', [SeatStatusController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Update
    Route::put('/{id}', [SeatStatusController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [SeatStatusController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [SeatStatusController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [SeatStatusController::class, 'restore'])->whereNumber('id');
});

/**
 * REST API - Room Status
 *
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('room-status')->group(function () {

    // Get list
    Route::get('/', [RoomStatusController::class, 'index']);

    // Get by ID
    Route::get('/{id}', [RoomStatusController::class, 'getById'])->whereNumber('id');

    // Create new
    Route::post('/', [RoomStatusController::class, 'store']);

    // Update
    Route::put('/{id}', [RoomStatusController::class, 'update'])->whereNumber('id');

    // Delete
    Route::delete('{id}/delete', [RoomStatusController::class, 'delete'])->whereNumber('id');
});

/**
 * REST API - Seat Status
 *
 * @author  TruongAn-Webdesigner <nguyentruongan0505@gmail.com>
 */
Route::prefix('items')->group(function () {
    // Get list
    Route::get('/', [ItemController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [ItemController::class, 'deleted']);

    // Create new
    Route::post('/', [ItemController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [ItemController::class, 'getById'])->whereNumber('id');

    // Get by slug
    Route::get('/{slug}', [ItemController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Update
    Route::put('/{id}', [ItemController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete', [ItemController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove', [ItemController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore', [ItemController::class, 'restore'])->whereNumber('id');
});



/**
 * REST API -Room
 *
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('rooms')->group(function () {
    // Get list
    Route::get('/', [RoomController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [RoomController::class, 'deleted']);

    // Create new
    Route::post('/', [RoomController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [RoomController::class, 'getById'])->whereNumber('id');

    // Get Seat of room
    Route::get('/{id}/seats', [RoomController::class, 'getSeats'])->whereNumber('id');

    // Get showtime of room
    Route::get('/{id}/showtimes', [RoomController::class, 'showtimes'])->whereNumber('id');

    // Update
    Route::put('/{id}', [RoomController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete', [RoomController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove', [RoomController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore', [RoomController::class, 'restore'])->whereNumber('id');
});

/**
 * REST API - Seat Status
 *
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('seats')->group(function () {
    // Get list
    Route::get('/', [SeatController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [SeatController::class, 'deleted']);

    // Create new
    Route::post('/', [SeatController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [SeatController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [SeatController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete', [SeatController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove', [SeatController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore', [SeatController::class, 'restore'])->whereNumber('id');
});


/**
 * REST API - Employee Role
 *
 * Date: 08/09/2021
 * Time: 13:00 AM
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('employee-roles')->group(function () {

    // Get list
    Route::get('/', [EmployeeRoleController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [EmployeeRoleController::class, 'deleted']);

    // Create new
    Route::post('/', [EmployeeRoleController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [EmployeeRoleController::class, 'getById'])->whereNumber('id');

    // Get Employees of Employee Role
    Route::get('/{id}/employees', [EmployeeRoleController::class, 'employees'])->whereNumber('id');

    // Update
    Route::put('/{id}', [EmployeeRoleController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [EmployeeRoleController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [EmployeeRoleController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [EmployeeRoleController::class, 'restore'])->whereNumber('id');
});


/**
 * REST API - Director
 *
 * Date: 11/09/2021
 * Time: 09:00 AM
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('directors')->group(function () {

    // Get list
    Route::get('/', [DirectorController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [DirectorController::class, 'deleted']);

    // Create new
    Route::post('/', [DirectorController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [DirectorController::class, 'getById'])->whereNumber('id');

    // Get Movie of director
    Route::get('/{id}/movies', [DirectorController::class, 'movies'])->whereNumber('id');

    // Update
    Route::put('/{id}', [DirectorController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [DirectorController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [DirectorController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [DirectorController::class, 'restore'])->whereNumber('id');

    // Get Movies
    Route::patch('{id}/movies/', [DirectorController::class, 'movies'])->whereNumber('id');
});
/**
 * REST API - Employee
 *
 * Date: 10/09/2021
 * Time: 18:00 AM
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('employee')->group(function () {

    // Get list
    Route::get('/', [EmployeeController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [EmployeeController::class, 'deleted']);

    // Create new
    Route::post('/', [EmployeeController::class, 'store']);

    // Get Blog by Employee
    Route::get('/{id}/blogs/', [EmployeeController::class, 'blogs'])->whereNumber('id');

    // Get by ID
    Route::get('/{id}', [EmployeeController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [EmployeeController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [EmployeeController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [EmployeeController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [EmployeeController::class, 'restore'])->whereNumber('id');
});



/**
 * REST API - Age Rating
 *
 * Date: 11/09/2021
 * Time: 14:00
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('age-ratings')->group(function () {

    // Get list
    Route::get('/', [AgeRatingController::class, 'index']);


    // Get deleted list
    Route::get('/deleted', [AgeRatingController::class, 'deleted']);

    // Get list movies of age rating
    Route::get('/{id}/movies', [AgeRatingController::class, 'movies']);

    // Create new
    Route::post('/', [AgeRatingController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [AgeRatingController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [AgeRatingController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [AgeRatingController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [AgeRatingController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [AgeRatingController::class, 'restore'])->whereNumber('id');
});


/**
 * REST API - Movies
 *
 * Date: 11/09/2021
 * Time: 15:00
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('movies')->group(function () {

    // Get list
    Route::get('/', [MovieController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [MovieController::class, 'deleted']);

    // Create new
    Route::post('/', [MovieController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [MovieController::class, 'getById'])->whereNumber('id');

    // Get genres of movie
    Route::get('/{id}/genres', [MovieController::class, 'genres'])->whereNumber('id');

    // Get actors of movie
    Route::get('/{id}/actors', [MovieController::class, 'actors'])->whereNumber('id');

    // Get director of movie
    Route::get('/{id}/directors', [MovieController::class, 'directors'])->whereNumber('id');

    // Get showtime of movie
    Route::get('/{id}/showtimes', [MovieController::class, 'showtimes'])->whereNumber('id');

    // Update
    Route::put('/{id}', [MovieController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [MovieController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [MovieController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [MovieController::class, 'restore'])->whereNumber('id');
});


/**
 * REST API - Movie Director
 *
 * Date: 11/09/2021
 * Time: 23:00
 * @author DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('movie-directors')->group(function () {

    // Get list
    Route::get('/', [MovieDirectorController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [MovieDirectorController::class, 'deleted']);

    // Create new
    Route::post('/', [MovieDirectorController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [MovieDirectorController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [MovieDirectorController::class, 'update'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [MovieDirectorController::class, 'remove'])->whereNumber('id');
});


/**
 * REST API - Movie Genre
 *
 * Date: 12/09/2021
 * Time: 09:30
 * @author DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('movie-genres')->group(function () {

    // Get list
    Route::get('/', [MovieGenreController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [MovieGenreController::class, 'deleted']);

    // Create new
    Route::post('/', [MovieGenreController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [MovieGenreController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [MovieGenreController::class, 'update'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [MovieGenreController::class, 'remove'])->whereNumber('id');
});


/**
 * REST API - Movie Actors
 *
 * Date: 12/09/2021
 * Time: 11:00
 * @author DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('movie-actors')->group(function () {

    // Get list
    Route::get('/', [MovieActorController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [MovieActorController::class, 'deleted']);

    // Create new
    Route::post('/', [MovieActorController::class, 'store']);

    // Update
    Route::put('/{id}', [MovieActorController::class, 'update'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [MovieActorController::class, 'remove'])->whereNumber('id');
});


/**
 * REST API - Customer Type
 *
 * Date: 12/09/2021
 * Time: 23:30 AM
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('customer-types')->group(function () {

    // Get list
    Route::get('/', [CustomerTypeController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [CustomerTypeController::class, 'deleted']);

    // Create new
    Route::post('/', [CustomerTypeController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [CustomerTypeController::class, 'getById'])->whereNumber('id');

    // Get Customers of Customer Type
    Route::get('/{id}/customers', [CustomerTypeController::class, 'customers'])->whereNumber('id');

    // Update
    Route::put('/{id}', [CustomerTypeController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [CustomerTypeController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [CustomerTypeController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [CustomerTypeController::class, 'restore'])->whereNumber('id');
});



/**
 * REST API - Customers
 *
 * Date: 12/09/2021
 * Time: 23:30
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('customers')->group(function () {

    // Get list
    Route::get('/', [CustomerController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [CustomerController::class, 'deleted']);

    // Create new
    Route::post('/', [CustomerController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [CustomerController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [CustomerController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [CustomerController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [CustomerController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [CustomerController::class, 'restore'])->whereNumber('id');
});


/**
 * REST API - Customers
 *
 * Date: 25/09/2021
 * Time: 12:22
 * @author  TruongAn-Webdesigner <nguyentruongan0505@gmail.com>
 */
Route::prefix('combo')->group(function () {

    // Get list
    Route::get('/', [ComboController::class, 'index']);

    // Get by id
    Route::get('/{id}', [ComboController::class, 'getById'])->whereNumber('id');

    // Get deleted list
    Route::get('/deleted', [ComboController::class, 'deleted']);

    // Get by slug
    Route::get('/{slug}', [ComboController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Create new
    Route::post('/', [ComboController::class, 'store']);

    // Update by id
    Route::put('/{id}', [ComboController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('/{id}/delete', [ComboController::class, 'delete'])->whereNumber('id');

    // Restore
    Route::patch('/{id}/restore', [ComboController::class, 'restore'])->whereNumber('id');

    // Remove
    Route::delete('/{id}/remove', [ComboController::class, 'remove'])->whereNumber('id');
});


/**
 * REST API - Customers
 *
 * Date: 27/09/2021
 * Time: 2:22
 * @author  TruongAn-Webdesigner <nguyentruongan0505@gmail.com>
 */
Route::prefix('comboticket')->group(function () {

    // Get list
    Route::get('/', [ComboTicketController::class, 'index']);

    // Get by id
    Route::get('/{id}', [ComboTicketController::class, 'getById'])->whereNumber('id');

    // Get deleted list
    Route::get('/deleted', [ComboTicketController::class, 'deleted']);

    // Get by slug
    Route::get('/{slug}', [ComboTicketController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Create new
    Route::post('/', [ComboTicketController::class, 'store']);

    // Update by id
    Route::put('/{id}', [ComboTicketController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('/{id}/delete', [ComboTicketController::class, 'delete'])->whereNumber('id');

    // Restore
    Route::patch('/{id}/restore', [ComboTicketController::class, 'restore'])->whereNumber('id');

    // Remove
    Route::delete('/{id}/remove', [ComboTicketController::class, 'remove'])->whereNumber('id');
});



/**
 * REST API - Customers
 *
 * Date: 2/10/2021
 * Time: 9:22
 * @author  TruongAn-Webdesigner <nguyentruongan0505@gmail.com>
 */
Route::prefix('comboitem')->group(function () {

    // Get list
    Route::get('/', [ComboItemController::class, 'index']);

    // Get by id
    Route::get('/{id}', [ComboItemController::class, 'getById'])->whereNumber('id');

    // Get deleted list
    Route::get('/deleted', [ComboItemController::class, 'deleted']);

    // Get by slug
    Route::get('/{slug}', [ComboItemController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Create new
    Route::post('/', [ComboItemController::class, 'store']);

    // Update by id
    Route::put('/{id}', [ComboItemController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('/{id}/delete', [ComboItemController::class, 'delete'])->whereNumber('id');

    // Restore
    Route::patch('/{id}/restore', [ComboItemController::class, 'restore'])->whereNumber('id');

    // Remove
    Route::delete('/{id}/remove', [ComboItemController::class, 'remove'])->whereNumber('id');
});

/**
 * REST API - Showtimes
 *
 * Date: 21/09/2021
 * Time: 20:30
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('showtimes')->group(function () {

    // Get list
    Route::get('/', [ShowtimeController::class, 'index']);

    // Get by ID
    Route::get('/{id}', [ShowtimeController::class, 'getById'])->whereNumber('id');

    // Get Movie Ticket of Showtime
    Route::get('/{id}/movie-ticket', [ShowtimeController::class, 'movieTicket'])->whereNumber('id');

    // Update
    Route::put('/', [ShowtimeController::class, 'update']);
});



/**
 * REST API - Movie Tickets
 *
 * Date: 21/09/2021
 * Time: 21:30
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */
Route::prefix('movie-tickets')->group(function () {

    // Get list
    Route::get('/', [MovieTicketController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [MovieTicketController::class, 'deleted']);

    // Create new
    Route::post('/', [MovieTicketController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [MovieTicketController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [MovieTicketController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [MovieTicketController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [MovieTicketController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [MovieTicketController::class, 'restore'])->whereNumber('id');
});


/** REST API - FIle Upload
 *
 * Date: 26/09/2021
 * Time: 19:30
 * @author  HUi <huynguyeexn@gmail.com>
 */

Route::prefix('uploads')->group(function () {

    // Get list
    Route::get('/', [FileUploadController::class, 'index']);

    // Image
    Route::get('/images', [FileUploadController::class, 'imageList']);
    Route::post('/images', [FileUploadController::class, 'imageUpload']);
});


/** REST API - Category
 *
 * Date: 05/10/2021
 * Time: 20:00
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */

Route::prefix('categories')->group(function () {

    // Get list
    Route::get('/', [CategoryController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [CategoryController::class, 'deleted']);

    // Create new
    Route::post('/', [CategoryController::class, 'store']);

    // Get Blog by Category
    Route::get('/{id}/blogs/', [CategoryController::class, 'blogs'])->whereNumber('id');

    // Get by ID
    Route::get('/{id}', [CategoryController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [CategoryController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [CategoryController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [CategoryController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [CategoryController::class, 'restore'])->whereNumber('id');
});


/** REST API - Blog
 *
 * Date: 05/10/2021
 * Time: 22:00
 * @author  DungLe-Webdesigner <dungle21092001@gmail.com>
 */

Route::prefix('blogs')->group(function () {

    // Get list
    Route::get('/', [BlogController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [BlogController::class, 'deleted']);

    // Create new
    Route::post('/', [BlogController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [BlogController::class, 'getById'])->whereNumber('id');

    // Update
    Route::put('/{id}', [BlogController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [BlogController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [BlogController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [BlogController::class, 'restore'])->whereNumber('id');
});
