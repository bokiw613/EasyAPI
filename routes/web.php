<?php

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TabelDataController;
use App\Http\Controllers\PermissionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/roles/{id}', [RoleController::class, 'show']);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');





Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rute yang memerlukan peran admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('permissions', PermissionController::class)->names('permissions');
    Route::resource('users', UserController::class);
    
});

// Rute yang memerlukan peran user atau admin untuk data
Route::middleware(['auth', 'permission'])->group(function () {
    Route::resource('data', TabelDataController::class);
    Route::get('/file/{filename}', [TabelDataController::class, 'showFile'])->name('file.show');
});


require __DIR__.'/auth.php';
