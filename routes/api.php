<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeliveryDayController;
use App\Http\Controllers\Api\MealPlansController;
use App\Http\Controllers\Api\MealTypeController;
use App\Http\Controllers\Api\RouteController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    });
    
    Route::get('/routes', [RouteController::class, 'routes'])->name('routes');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/summary', [TestimonialController::class, 'getSummaryTestimonial'])->name('testimonials.summary');
    Route::get('/testimonials/happy-customers', [TestimonialController::class, 'getTotalHappyCustomers'])->name('testimonials.happy-customers');
    
    Route::get('/meal-plans', [MealPlansController::class, 'index'])->name('meal-plans.index');
    
    Route::get('/subscriptions/total', [SubscriptionController::class, 'getTotalSubscriptions'])->name('subscriptions.total');
    
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/meal-types', [MealTypeController::class, 'index'])->name('meal-types.index');
    
        Route::get('/delivery-days', [DeliveryDayController::class, 'index'])->name('delivery-days.index');

        Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        
        Route::middleware('check.api.role:user')->group(function () {
            Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
        });

        Route::middleware('check.api.role:admin')->group(function () {
            
        });
    });
});