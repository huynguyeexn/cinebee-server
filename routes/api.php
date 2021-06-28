<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CinemaStatusController;
use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\SeatStatusController;
use Illuminate\Support\Facades\Route;

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
 * REST API - Seat Status
 *
 * Date: 26/06/2021
 * Time: 11:10 AM
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
 * Date: 26/06/2021
 * Time: 11:10 AM
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('room-status')->group(function () {

    // Get list
    Route::get('/', [RoomStatusController::class, 'index']);

    // Get deleted list
    // Route::get('/deleted', [RoomStatusController::class, 'deleted']);

    // Create new
    Route::post('/', [RoomStatusController::class, 'store']);

    // Get by ID
    // Route::get('/{id}', [RoomStatusController::class, 'getById'])->whereNumber('id');

    // Get by slug
    // Route::get('/{slug}', [RoomStatusController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Update
    // Route::put('/{id}', [RoomStatusController::class, 'update'])->whereNumber('id');

    // Soft Delete
    // Route::delete('{id}/delete/', [RoomStatusController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    // Route::delete('{id}/remove/', [RoomStatusController::class, 'remove'])->whereNumber('id');

    // Restore
    // Route::patch('{id}/restore/', [RoomStatusController::class, 'restore'])->whereNumber('id');
});


/**
 * REST API - Cinema Status
 *
 * Date: 28/06/2021
 * Time: 10:10 AM
 * @author  TruongAn-Webdesigner <nguyentruongan0505@gmail.com>
 */
Route::prefix('cinema-status')->group(function () {

    // Get list
    Route::get('/', [CinemaStatusController::class, 'index']);

    // Get deleted list
    //Route::get('/deleted', [CinemaStatusController::class, 'deleted']);

    // Create new
    Route::post('/', [CinemaStatusController::class, 'store']);

    // Get by ID
    Route::get('/{id}', [CinemaStatusController::class, 'getById'])->whereNumber('id');

    // Get by slug
    Route::get('/{slug}', [CinemaStatusController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Update
    Route::put('/{id}', [CinemaStatusController::class, 'update'])->whereNumber('id');

    // Soft Delete
    Route::delete('{id}/delete/', [CinemaStatusController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    Route::delete('{id}/remove/', [CinemaStatusController::class, 'remove'])->whereNumber('id');

    // Restore
    Route::patch('{id}/restore/', [CinemaStatusController::class, 'restore'])->whereNumber('id');
});
