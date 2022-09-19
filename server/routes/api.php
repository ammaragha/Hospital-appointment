<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\UserController;
use App\Models\Reservation;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/////////////////// Authintcation ///////////////////
Route::post('token/create', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
/////////////////////////////////////////////////////

Route::group(['middleware' => 'auth:sanctum', 'namespeace' => 'Api'], function () {
    Route::group(['prefix'=>'user'],function ()
    {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/reservations', [ReservationController::class, 'allForUser']);
        Route::get('/waited-reservations', [ReservationController::class, 'waitedForUser']);

    });

    Route::get('/specialities', [SpecialtyController::class, 'index']);

    Route::get('/worktime', [SettingController::class, 'getWorkTime']);

    /////////////////////// Reservations ////////////////////////
    Route::post('/reserve', [ReservationController::class, 'store']);
    Route::get('/reservations',[ReservationController::class,'index']);
    Route::get('/today-reservations',[ReservationController::class,'todayReservations']);
});
