<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\HomeController;

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
    return view('index');
});

Auth::routes();

// Welcome screen for new users - already protected with auth middleware in controller
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/welcome', [WelcomeController::class, 'storeDecision'])->name('welcome.decision');

// Dashboard and other authenticated routes
Route::middleware(['auth', 'web'])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Redirect /home to dashboard
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });

    // Store routes
    Route::resource('stores', StoreController::class)->except(['index', 'destroy']);
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // User management
    Route::resource('users', UserManagementController::class);

    // Role management
    Route::resource('roles', RoleController::class);
    Route::post('/delete-permission', 'App\Http\Controllers\RoleController@deletePermission')->name('delete.permission');
    Route::post('/update-permission', 'App\Http\Controllers\RoleController@updatePermission')->name('update.permission');
});
