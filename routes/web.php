<?php

use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/dashboard')->middleware('auth')->name('back.')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/category/status-update/{id}', [CategoryController::class, 'statusUpdate'])->name('category.statusUpdate');
    Route::resource('/category', CategoryController::class);

    Route::delete('/product/image-delete/{id}', [ProductController::class, 'imageDelete'])->name('product.imageDelete');
    Route::resource('/product', ProductController::class);

});
