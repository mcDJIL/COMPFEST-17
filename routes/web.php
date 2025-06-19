<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('check.token')->group(function () {
    Route::prefix('auth')->group(function () {
        // Redirect
        Route::get('/redirect', function () {
            $user = Auth::user();

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
});
