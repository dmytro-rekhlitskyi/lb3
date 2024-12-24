<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::post('/users/create', [\App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
Route::post('/users/update', [\App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
Route::post('/users/delete', [\App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete');

