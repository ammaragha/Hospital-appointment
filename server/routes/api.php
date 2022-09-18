<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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
    Route::get('/user', [UserController::class, 'index']);
});
