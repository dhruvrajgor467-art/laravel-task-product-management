<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
});

//Customer login/register routes
Route::prefix('customer')->group(function () {
    
    Route::get('/register',[AuthController::class,'showRegister'])->name('show.register');
    Route::get('/login',[AuthController::class,'showLogin'])->name('show.login');

    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::post('/login',[AuthController::class,'login'])->name('login');

    Route::middleware(['auth:customer', 'role:customer'])->group(function () {
        Route::get('dashboard', fn () => view('customer.dashboard'))
            ->name('customer.dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('customer.logout');

});

//Admin Login Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('login', [AuthController::class, 'adminLogin'])->name('admin.login');

    Route::middleware(['auth:admin', 'role:admin'])->group(function () {
        Route::get('dashboard', fn () => view('admin.dashboard'))
            ->name('admin.dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

});

Route::middleware(['auth:admin', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    });

Route::post('admin/products/import',[ProductController::class, 'import'])->name('admin.products.import');