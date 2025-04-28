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
        
        // Scholarship Management Routes
        Route::resource('scholarships', App\Http\Controllers\Admin\ScholarshipController::class)
            ->except(['create', 'edit', 'destroy'])
            ->names('admin.scholarships');
        Route::post('scholarships/import', [App\Http\Controllers\Admin\ScholarshipController::class, 'import'])
            ->name('admin.scholarships.import');
        Route::get('scholarships/export', [App\Http\Controllers\Admin\ScholarshipController::class, 'export'])
            ->name('admin.scholarships.export');

        // Attendance Management Routes
        Route::prefix('attendance')->name('admin.attendance.')->group(function () {
            Route::get('/regular', [App\Http\Controllers\Admin\AttendanceController::class, 'regular'])->name('regular');
            Route::get('/css', [App\Http\Controllers\Admin\AttendanceController::class, 'css'])->name('css');
            Route::get('/cgg', [App\Http\Controllers\Admin\AttendanceController::class, 'cgg'])->name('cgg');
            Route::put('/update/{user}', [App\Http\Controllers\Admin\AttendanceController::class, 'update'])->name('update');
        });

        // Journal Management Routes
        Route::resource('journals', App\Http\Controllers\Admin\JournalController::class)->names('admin.journals');
        Route::get('journals/statistics', [App\Http\Controllers\Admin\JournalController::class, 'statistics'])
            ->name('admin.journals.statistics');



  
    });
});
