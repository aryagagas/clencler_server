<?php

use App\Http\Controllers\API\MitraController;
use App\Http\Controllers\API\UserController;
use Illuminate\Foundation\Auth\User;
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

// Route::post('mitra/login',[MitraController::class, 'login']);


Route::group(['prefix' => 'user'], function () {
    Route::post('/route3', function (Request $request) {
        return 'Route 3';
    });
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/profile', function (Request $request) {
            // return auth()->user();
            return auth('mitra')->user();
        });

        // API route for logout user
        Route::post('/logout', [UserController::class, 'logout']);
    });
});
Route::group(['prefix' => 'mitra'], function () {
    Route::get('/route3', function () {
        return 'Route 3';
    });
    Route::post('/register', [MitraController::class, 'register']);
    Route::post('/login', [MitraController::class, 'login']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/profile', function (Request $request) {
            return auth()->user();
        });

        // API route for logout user
        Route::post('/logout', [MitraController::class, 'logout']);
    });
});