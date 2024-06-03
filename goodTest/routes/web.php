<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create', [App\Http\Controllers\CreateTestController::class, 'index'])->name('create');

