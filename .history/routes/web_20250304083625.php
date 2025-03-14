<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,BerkasEmployeeController,NilaiController,UserController};


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', UserController::class);


Route::middleware(['auth'])->group(function () {
    
});


Route::middleware(['auth', 'Admin'])->group(function () {
    
});


Route::middleware(['auth', 'SuperAdmin'])->group(function () {
    
});