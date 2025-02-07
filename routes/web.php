<?php

use App\Http\Controllers\Back\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/dashboard')->middleware('auth')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

});

