<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserJobController;
use App\Http\Controllers\Admin\EmployersController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\User\ProfileController;
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
    Route::patch('user/{user}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');
    Route::patch('user/{user}/activate', [UserController::class, 'activate'])->name('user.activate');

    // Admin Jobs
    Route::get('jobs', [JobsController::class, 'index'])->name('jobs'); // Admin job listing
    Route::get('jobs/create', [JobsController::class, 'create'])->name('job.create'); // Admin create job
    Route::get('jobs/{job}', [JobsController::class, 'show'])->name('job.show'); // Admin create job
    Route::post('jobs', [JobsController::class, 'store'])->name('job.store'); // Admin store job
    Route::get('jobs/{job}/edit', [JobsController::class, 'edit'])->name('job.edit'); // Admin edit job
    Route::patch('jobs/{job}', [JobsController::class, 'update'])->name('job.update'); // Admin update job
    Route::delete('jobs/{job}', [JobsController::class, 'destroy'])->name('job.destroy'); // Admin delete job

    //Admin Employer
    Route::get('/employers', [EmployersController::class, 'index'])->name('employers');
    Route::get('/employers/create', [EmployersController::class, 'create'])->name('employer.create');
    Route::post('/employers/create', [EmployersController::class, 'store'])->name('employer.store');
    Route::get('/employers/{employer}', [EmployersController::class, 'show'])->name('employer.show');
    Route::get('/employers/{employer}/edit', [EmployersController::class, 'edit'])->name('employer.edit');
    Route::patch('/employers/{employer}', [EmployersController::class, 'update'])->name('employer.update');
    Route::delete('/employers/{employer}', [EmployersController::class, 'destroy'])->name('employer.destroy');
});

// User Route
Route::get('/user-job', [UserJobController::class, 'index'])->name('user-job');
Route::get('/user-job/{user}', [UserJobController::class, 'singleUserJob'])->name('single-user-job');

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

Route::prefix('profile')->middleware('auth')->name('profile.')->group(function () {
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::get('edit/{user}', [ProfileController::class, 'edit'])->name('edit');
    ROute::get('password/{user}', [ProfileController::class, 'password'])->name('password');
    Route::patch('update/{user}', [ProfileController::class, 'update'])->name('update');
    Route::delete('delete/{user}', [ProfileController::class, 'destroy'])->name('destroy');
});

// Search and Tag Routes
Route::get('/search', SearchController::class);
Route::get('/tags/{tag:name}', TagController::class);

// Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

// Logout Route
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
