<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeRoleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomStatusController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SeatStatusController;
use App\Models\EmployeeRole;
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
