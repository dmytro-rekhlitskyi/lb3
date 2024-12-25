<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::post('/users/create', [\App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
Route::post('/users/u   pdate', [\App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
Route::post('/users/delete', [\App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete');

