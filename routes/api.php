<?php

use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\DeviceApplicationController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\UserController;
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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() {

    Route::post('/register', [UserController::class, 'register'])->name('register');

    Route::group(['as' => 'device.', 'prefix' => 'devices', 'middleware' => ['api', 'auth:sanctum']], function () {
        Route::get('/', [DeviceController::class, 'index'])->name('index');
        Route::get('{id}', [DeviceController::class, 'show'])->name('show');
        Route::post('/', [DeviceController::class, 'store'])->name('store');

        Route::group(['as' => 'application.', 'prefix' => 'application', 'middleware' => ['api', 'auth:sanctum']], function () {
            Route::get('/', [DeviceApplicationController::class, 'index'])->name('index');
            Route::post('/', [DeviceApplicationController::class, 'store'])->name('index');
        });
    });

    Route::group(['as' => 'payment.', 'prefix' => 'reports', 'middleware' => ['api', 'auth:sanctum']], function () {
        Route::get('payments', [DeviceApplicationController::class, 'report'])->name('report');
    });

    Route::group(['as' => 'application.', 'prefix' => 'applications', 'middleware' => ['api', 'auth:sanctum']], function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::get('{id}', [ApplicationController::class, 'show'])->name('show');
    });

});
