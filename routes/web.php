<?php

use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/dashboard')->middleware('auth')->name('back.')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/category/status-update/{id}', [CategoryController::class, 'statusUpdate'])->name('category.statusUpdate');
    Route::resource('/category', CategoryController::class);
});

