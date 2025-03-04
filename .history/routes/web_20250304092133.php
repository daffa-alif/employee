<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,BerkasEmployeeController,NilaiController,UserController};


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard'); // Ensure you have a `dashboard.blade.php` file.
})->middleware('auth')->name('dashboard');




Route::middleware(['auth'])->group(function () {
    Route::get('/berkas', [BerkasEmployeeController::class, 'index'])->name('berkas.index');
    Route::get('/berkas/create', [BerkasEmployeeController::class, 'create'])->name('berkas.create');
    Route::post('/berkas', [BerkasEmployeeController::class, 'store'])->name('berkas.store');
    Route::get('/berkas/edit', [BerkasEmployeeController::class, 'edit'])->name('berkas.edit');
    Route::put('/berkas', [BerkasEmployeeController::class, 'update'])->name('berkas.update');
});


Route::middleware(['auth', 'Admin'])->group(function () {
    

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});


Route::middleware(['auth', 'SuperAdmin'])->group(function () {
    
});