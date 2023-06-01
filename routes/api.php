<?php

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
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix'=>'transaksi'], function(){
            Route::get('/get/{userid}', [TransaksiController::class,'getUserTransaksi']);
            Route::post('/update/{transaksiid}', [TransaksiController::class,'updateTransaksi']);
            Route::post('/create', [TransaksiController::class,'createTransaksi']);
        });
        Route::group(['prefix'=>'post'], function(){
            Route::get('/get', [PostController::class, 'getAllPosts']);
            Route::get('/get/{postid}', [PostController::class, 'getPost']);
        });
        Route::group(['prefix' => 'mitra'], function(){
            Route::get('/get', [UserController::class, 'getAllMitras']);
            Route::get('/get/{mitraid}', [UserController::class, 'getMitra']);
        });
        Route::get('/profile/{userid}', [UserController::class, 'getProfile']);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});

// Routing API untuk mitra
Route::group(['prefix' => 'mitra'], function () {
    Route::post('/register', [MitraController::class, 'register']);
    Route::post('/login', [MitraController::class, 'login']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix'=>'post'], function(){
            Route::get('/get', [PostController::class, 'getAllPosts']);
            Route::get('/get/{postid}', [PostController::class, 'getPost']);
            Route::post('/create', [PostController::class, 'createPost']);
        });
        Route::group(['prefix'=>'transaksi'], function(){
            Route::get('/get/{mitraid}', [TransaksiController::class,'getMitraTransaksi']);
        });
        Route::get('/profile/{mitraid}', [MitraController::class, 'getProfile']);
        Route::post('/logout', [MitraController::class, 'logout']);
    });
});
