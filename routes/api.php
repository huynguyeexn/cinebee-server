<?php

use App\Http\Controllers\AuthController;
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
 * Date: 24/06/2021
 * Time: 09:20 PM
 * @author  HUi <huynguyeexn@gmail.com>
 */
Route::prefix('seat-status')->group(function () {

    // Get list
    Route::get('/', [SeatStatusController::class, 'index']);

    // Create new
    Route::post('/', [SeatStatusController::class, 'create']);

    // Get by ID
    Route::get('/{id}', [SeatStatusController::class, 'getById'])->whereNumber('id');

    // Get by slug
    Route::get('/{slug}', [SeatStatusController::class, 'getBySlug'])->where(['slug' => '^[a-z0-9-]+$']);

    // Update
    // Route::put('/', [SeatStatusController::class, 'update']);

    // Soft Delete
    // Route::delete('/delete/{id}', [SeatStatusController::class, 'delete'])->whereNumber('id');

    // Hard Delete
    // Route::delete('/remove/{id}', [SeatStatusController::class, 'remove'])->whereNumber('id');

    // Restore
    // Route::put('/restore/{id}', [SeatStatusController::class, 'update'])->whereNumber('id');
});
