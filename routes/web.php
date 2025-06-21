<?php

use App\Http\Controllers\FuncController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('check.token')->group(function () {
    Route::prefix('auth')->group(function () {
        // Redirect
        Route::get('/redirect', function () {
            $user = FuncController::get_profile();

            if (!$user) {
                return redirect()->route('auth.login');
            }
            return redirect()->route('index');
        })->name('redirect');

        Route::get('/login', fn() => view('auth.login'))->name('auth.login');
        Route::get('/register', fn() => view('auth.register'))->name('auth.register');
    });

    Route::get('/', function () {
        return view('landing-page.index');
    })->name('index');
    
    Route::middleware('check.permission:user,admin')->group(function () {
        Route::get('/subscription', function () {
            return view('subscription.index');
        })->name('subscription.index');
    });

    Route::middleware('check.permission:user')->group(function () {
        Route::get('/dashboard/user', function () {
            return view('dashboard.user.index');
        })->name('dashboard.user.index');

        Route::get('/dashboard/user/profile', function () {
            return view('dashboard.user.profile');
        })->name('dashboard.user.profile');
    });

    Route::middleware('check.permission:admin')->group(function () {
        Route::get('/dashboard/admin', function () {
            return view('dashboard.admin.index');
        })->name('dashboard.admin.index');

        Route::get('/dashboard/admin/profile', function () {
            return view('dashboard.admin.profile');
        })->name('dashboard.admin.profile');
    });
});
