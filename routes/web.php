<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::prefix('subcribirse')->group(function () {
    $controller = App\Http\Controllers\SubcribirseController::class;

    // Route::get('/',[$controller,'index']);
    Route::post('check_email',[$controller,'checkEmail']);
});