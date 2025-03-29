<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Route::get("/login", [UserController::class, "index"])->name('login');
Route::get('/', function () {
    return Inertia::render("Home");
})->name('home');

Route::resource('/user', UserController::class);

Route::resource('user.address', AddressController::class);
