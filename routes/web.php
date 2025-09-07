<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Payment Proof Search Route (Public Access)
Route::get('/files/search', [App\Http\Controllers\PaymentProofSearchController::class, 'search'])->name('files.search');

// Student Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Student\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Student\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Student\AuthController::class, 'logout'])->name('logout');

    // Protected Student Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
        
        // Journal Routes
        Route::resource('journals', App\Http\Controllers\Student\JournalController::class)
            ->names('journals')
            ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::post('journals/store-image', [App\Http\Controllers\Student\JournalController::class, 'storeImage'])
            ->name('journals.store-image');
        
        // Permission Request Routes
        Route::resource('permissions', App\Http\Controllers\Student\PermissionRequestController::class)
            ->except(['edit', 'update'])
            ->names('permissions')
            ->only(['index', 'create', 'store', 'show', 'destroy']);
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {
        // Settings Routes
        Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings.index');
        Route::put('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('admin.settings.update');

        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names('admin.users');
        
        // Student Bulk Import Routes
        Route::get('students/bulk-import', [App\Http\Controllers\Admin\StudentBulkImportController::class, 'index'])->name('admin.students.bulk-import');
        Route::get('students/bulk-import/template', [App\Http\Controllers\Admin\StudentBulkImportController::class, 'downloadTemplate'])->name('admin.students.bulk-import.template');
        Route::post('students/bulk-import', [App\Http\Controllers\Admin\StudentBulkImportController::class, 'import'])->name('admin.students.bulk-import.process');
        Route::resource('admins', App\Http\Controllers\Admin\AdminController::class)->names('admin.admins');
        
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
            Route::get('/', [App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('index');
            Route::get('/regular', [App\Http\Controllers\Admin\AttendanceController::class, 'regular'])->name('regular');
            Route::get('/css', [App\Http\Controllers\Admin\AttendanceController::class, 'css'])->name('css');
            Route::get('/cgg', [App\Http\Controllers\Admin\AttendanceController::class, 'cgg'])->name('cgg');
            Route::put('/update/{user}', [App\Http\Controllers\Admin\AttendanceController::class, 'update'])->name('update');
            Route::get('/import', [App\Http\Controllers\Admin\AttendanceController::class, 'showImport'])->name('import');
            Route::post('/import', [App\Http\Controllers\Admin\AttendanceController::class, 'import'])->name('import.process');
            Route::get('/template', [App\Http\Controllers\Admin\AttendanceController::class, 'downloadTemplate'])->name('template');
        });

        // Permission Request Management Routes
        Route::get('permissions/export', [App\Http\Controllers\Admin\PermissionRequestController::class, 'export'])
            ->name('admin.permissions.export');
        Route::resource('permissions', App\Http\Controllers\Admin\PermissionRequestController::class)
            ->only(['index', 'show', 'update'])
            ->names('admin.permissions');

        // Journal Management Routes
        Route::get('journals/download-all', [App\Http\Controllers\Admin\JournalController::class, 'downloadAll'])
            ->name('admin.journals.download-all');
        Route::get('journals/statistics', [App\Http\Controllers\Admin\JournalController::class, 'statistics'])
            ->name('admin.journals.statistics');
        Route::get('journals/entry/{journal}', [App\Http\Controllers\Admin\JournalController::class, 'entryShow'])
            ->name('admin.journals.entry-show');
        Route::get('journals/{id}/preview', [App\Http\Controllers\Admin\JournalController::class, 'preview'])
            ->name('admin.journals.preview');
        Route::get('journals/{id}/download', [App\Http\Controllers\Admin\JournalController::class, 'download'])
            ->name('admin.journals.download');
        Route::resource('journals', App\Http\Controllers\Admin\JournalController::class)->names('admin.journals');

        // Batch Management Routes
        
        // Class Management Routes
        // Route::resource('classes', App\Http\Controllers\Admin\ClassController::class)->names('admin.classes');
    });
});
