<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'users'], function () {
    Route::post('/register', [UserController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'books'], function () {
        Route::get('/', [BookController::class, 'index']);
        Route::get('/{id}', [BookController::class, 'show']);
        Route::post('/create', [BookController::class, 'store']);
        Route::put('/update/{id}', [BookController::class, 'update']);
        Route::delete('/delete/{id}', [BookController::class, 'destroy']);
    });

    Route::group(['prefix' => 'stores'], function () {
        Route::get('/', [StoreController::class, 'index']);
        Route::get('/{id}', [StoreController::class, 'show']);
        Route::post('/create', [StoreController::class, 'store']);
        Route::put('/update/{id}', [StoreController::class, 'update']);
        Route::delete('/delete/{id}', [StoreController::class, 'destroy']);

        Route::post('/{storeId}/add-book/{bookId}', [StoreController::class, 'addBook']);
        Route::delete('/{storeId}/remove-book/{bookId}', [StoreController::class, 'removeBook']);
    });
});