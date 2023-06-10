<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\LaporanController;
use App\Http\Controllers\API\MitraController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'mitra'], function () {
    Route::post('/register', [MitraController::class, 'register']);
    Route::post('/login', [MitraController::class, 'login']);
    Route::post('/logout', [MitraController::class, 'logout']);
    // Done
    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/{mitra_id}', [TransaksiController::class, 'getMitraTransaksi']);
        Route::get('/detail/{transaksi_id}', [TransaksiController::class, 'getDetailTransaksi']);
    });
    // Done
    Route::group(['prefix' => 'post'], function () {
        Route::post('/', [PostController::class, 'createPost']);
        Route::get('/', [PostController::class, 'getAllPost']);
        Route::get('/{mitra_id}', [PostController::class, 'getDetailPost']);
    });
    // Done
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/{mitra_id}', [MitraController::class, 'getProfile']);
        Route::post('/updateProfile/{mitra_id}', [MitraController::class, 'updateProfile']);
        Route::post('/updatepass/{mitra_id}', [MitraController::class, 'updatepass']);
    });
});

