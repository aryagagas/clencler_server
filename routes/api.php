<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\LaporanController;
use App\Http\Controllers\API\MitraController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routing untuk user
Route::group(['prefix' => 'user'], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
    // Done
    Route::group(['prefix' => 'transaksi'], function () {
        Route::post('/', [TransaksiController::class, 'createTransaksi']);
        Route::get('/{user_id}', [TransaksiController::class, 'getUserTransaksi']);
        Route::get('/detail/{transaksi_id}', [TransaksiController::class, 'getDetailTransaksi']);
    });
    // Done
    Route::group(['prefix' => 'mitra'], function () {
        Route::get('/', [MitraController::class, 'getAllMitra']);
        Route::get('/{mitra_id}', [MitraController::class, 'getDetailMitra']);
    });
    // Done
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'getAllPost']);
        Route::get('/{post_id}', [PostController::class, 'getDetailPost']);
    });
    // Done
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/{user_id}', [UserController::class, 'getProfile']);
        Route::post('/{user_id}', [UserController::class, 'updateProfile']);
    });
});

// Routing API untuk mitra
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
        Route::post('/{mitra_id}', [MitraController::class, 'updateProfile']);
    });
});

// Routing API untuk Admin
Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout']);
    // Done
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'getAllUser']);
        Route::get('/{user_id}', [UserController::class, 'getProfile']);
    });
    // Done
    Route::group(['prefix' => 'mitra'], function () {
        Route::get('/', [MitraController::class, 'getAllMitra']);
        Route::get('/{mitra_id}', [MitraController::class, 'getDetailMitra']);
    });
    // Done
    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', [TransaksiController::class, 'getAllTransaksi']);
        Route::get('/{transaksi_id}', [TransaksiController::class, 'getDetailTransaksi']);
    });
    // Done
    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', [LaporanController::class, 'getAllLaporan']);
        Route::get('/{laporan_id}', [LaporanController::class, 'getDetailLaporan']);
    });
});