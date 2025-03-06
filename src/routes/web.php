<?php

use Illuminate\Support\Facades\Route;
use PhapNguyenDuc\LaravelManager\Http\Controllers\DashboardController;
use PhapNguyenDuc\LaravelManager\Http\Controllers\ProfileController;
use PhapNguyenDuc\LaravelManager\Http\Controllers\RedisManagerController;
use PhapNguyenDuc\LaravelManager\Http\Controllers\RegisterController;
use PhapNguyenDuc\LaravelManager\Http\Controllers\SessionsController;

Route::middleware('web')->group(function () {
    Route::get('/', function () {return redirect('dashboard');})->middleware('guest');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
    Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
    Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
    Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
    Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
    Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
    Route::get('verify', function () {
        return view('laravel-manager::sessions.password.verify');
    })->middleware('guest')->name('verify');
    Route::get('/reset-password/{token}', function ($token) {
        return view('laravel-manager::sessions.password.reset', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
    Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
    Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('billing', function () {
            return view('laravel-manager::pages.billing');
        })->name('billing');
        Route::get('tables', function () {
            return view('laravel-manager::pages.tables');
        })->name('tables');
        Route::get('rtl', function () {
            return view('laravel-manager::pages.rtl');
        })->name('rtl');
        Route::get('virtual-reality', function () {
            return view('laravel-manager::pages.virtual-reality');
        })->name('virtual-reality');
        Route::get('notifications', function () {
            return view('laravel-manager::pages.notifications');
        })->name('notifications');
        Route::get('static-sign-in', function () {
            return view('laravel-manager::pages.static-sign-in');
        })->name('static-sign-in');
        Route::get('static-sign-up', function () {
            return view('laravel-manager::pages.static-sign-up');
        })->name('static-sign-up');
        Route::get('user-management', function () {
            return view('laravel-manager::pages.laravel-examples.user-management');
        })->name('user-management');
        Route::get('user-profile', function () {
            return view('laravel-manager::pages.laravel-examples.user-profile');
        })->name('user-profile');
    });
    Route::prefix('redis-manager')->group(function () {
        Route::controller(RedisManagerController::class)->group(function () {
            Route::get('/', 'index')->name('redis-manager.index');
            Route::get('/search', 'search')->name('redis-manager.search');
            Route::delete('/delete', 'delete')->name('redis-manager.delete');
            Route::delete('/delete-all', 'deleteAll')->name('redis-manager.deleteAll');
            Route::post('/update', 'updateKey')->name('redis-manager.update');
        });
    });
});
