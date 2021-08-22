<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubcribirseController as SubcribirseV1;

Route::prefix('v1')->group(function () {

    Route::middleware(['auth:sanctum'])->group(function () {


        Route::prefix('subcribirse')->group(function () {
            Route::get('list',[SubcribirseV1::class,'list']);
        });

        Route::get('logout', [
            App\Http\Controllers\Api\V1\LoginController::class,
            'logout'
        ]);
    });

    Route::post('login', [
        App\Http\Controllers\Api\V1\LoginController::class,
        'login'
    ]);
    Route::post('register', [
        App\Http\Controllers\Api\V1\RegisterController::class,
        'register'
    ]);
    
});