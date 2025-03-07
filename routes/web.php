<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('files/search', [App\Http\Controllers\Admin\FileController::class, 'search'])->name('files.search');



Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names('admin.users');
        Route::resource('admins', App\Http\Controllers\Admin\AdminController::class)->names('admin.admins');
        Route::resource('files', App\Http\Controllers\Admin\FileController::class)->names('admin.files');
        Route::get('files/{file}/view', [App\Http\Controllers\Admin\FileController::class, 'view'])->name('admin.files.view');



  
    });
});
