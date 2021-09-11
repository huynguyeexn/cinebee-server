<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeRoleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SeatStatusController;
use App\Models\EmployeeRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\AgeRatingController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;

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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::middleware(['auth:api'])->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
    });
});
/**
 * REST API - actor
 *  long add 06-09-2021
 */
Route::prefix('actors')->group(function () {
    Route::get('/',[ActorController::class,'index']);
     // Get deleted list
     Route::get('/deleted', [ActorController::class, 'deleted']);

     // Create new
     Route::post('/', [ActorController::class, 'store']);

     // Get by ID
     Route::get('/{id}', [ActorController::class, 'getById'])->whereNumber('id');

     // Get by slug
     Route::get('/{slug}', [ActorController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

     // Update
     Route::put('/{id}', [ActorController::class, 'update'])->whereNumber('id');

     // Soft Delete
     Route::delete('{id}/delete/', [ActorController::class, 'delete'])->whereNumber('id');

     // Hard Delete
     Route::delete('{id}/remove/', [ActorController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [ActorController::class, 'restore'])->whereNumber('id');
});
/**
 * REST API - genre
 *  long add 06-09-2021
 */
Route::prefix('genres')->group(function () {
    Route::get('/',[GenreController::class,'index']);
     // Get deleted list
     Route::get('/deleted', [GenreController::class, 'deleted']);

     // Create new
     Route::post('/', [GenreController::class, 'store']);

     // Get by ID
     Route::get('/{id}', [GenreController::class, 'getById'])->whereNumber('id');

     // Get by slug
     Route::get('/{slug}', [GenreController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

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
Route::prefix('employee-role')->group(function () {

    // Get list
    Route::get('/', [EmployeeRoleController::class, 'index']);

    // Get deleted list
    Route::get('/deleted', [EmployeeRoleController::class, 'deleted']);

    // Create new
    Route::post('/', [EmployeeRoleController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [EmployeeRoleController::class, 'getById'])->whereNumber('id');

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

    // Update
    Route::put('/{id}', [DirectorController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [DirectorController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [DirectorController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [DirectorController::class, 'restore'])->whereNumber('id');
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

    // Update
    Route::put('/{id}', [MovieController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [MovieController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [MovieController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [MovieController::class, 'restore'])->whereNumber('id');
});
