<?php
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('users/create', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // Admin Jobs
    Route::get('jobs', [JobsController::class, 'index'])->name('jobs'); // Admin job listing
    Route::get('jobs/create', [JobsController::class, 'create'])->name('job.create'); // Admin create job
    Route::get('jobs/{job}', [JobsController::class, 'show'])->name('job.show'); // Admin create job
    Route::post('jobs', [JobsController::class, 'store'])->name('job.store'); // Admin store job
    Route::get('jobs/{job}/edit', [JobsController::class, 'edit'])->name('job.edit'); // Admin edit job
    Route::patch('jobs/{job}', [JobsController::class, 'update'])->name('job.update'); // Admin update job
    Route::delete('jobs/{job}', [JobsController::class, 'destroy'])->name('job.destroy'); // Admin delete job
});

// Public Routes
Route::get('/', [JobController::class, 'index']); // Public job listing
Route::get('/jobs/{job}', [JobController::class, 'show']); // Public job details
Route::get('/job/create', [JobController::class, 'create'])->middleware('auth')->name('jobs.create'); // Public create job page (auth required)
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth'); // Public store job (auth required)
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job'); // Edit job (auth required and permission check)
Route::patch('/jobs/{job}', [JobController::class, 'update'])->middleware('auth'); // Update job (auth required)
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('auth'); // Delete job (auth required)

// Search and Tag Routes
Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class);

// Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

// Logout Route
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
