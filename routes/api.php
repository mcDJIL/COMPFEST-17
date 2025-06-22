<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardAdminController;
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
            Route::get('/subscriptions/active', [SubscriptionController::class, 'getActiveSubscription'])->name('subscriptions.active');
            Route::put('/subscriptions/{id}/pause', [SubscriptionController::class, 'pauseSubscription'])->name('subscriptions.pause');
            Route::put('/subscriptions/{id}/continue', [SubscriptionController::class, 'continueSubscription'])->name('subscriptions.continue');
            Route::put('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscriptions.cancel');
        });
        
        Route::middleware('check.api.role:admin')->group(function () {
            Route::get('/dashboard/subscriptions/total-revenue', [DashboardAdminController::class, 'totalRevenue'])->name('dashboard.subscriptions.total-revenue');
            Route::get('/dashboard/subscriptions/active-subs-revenue', [DashboardAdminController::class, 'activeSubscriptionsRevenue'])->name('dashboard.subscriptions.active-subs-revenue');
            Route::get('/dashboard/subscriptions/active-subscriptions', [DashboardAdminController::class, 'activeSubscriptions'])->name('dashboard.subscriptions.active-subscriptions');
            Route::get('/dashboard/subscriptions/monthly-recurring', [DashboardAdminController::class, 'monthlyRecurringRevenue'])->name('dashboard.subscriptions.monthly-recurring');
            Route::get('/dashboard/subscriptions/subscriptions-growth', [DashboardAdminController::class, 'subscriptionsGrowth'])->name('dashboard.subscriptions.subscriptions-growth');
            Route::get('/dashboard/subscriptions/subscriptions-status', [DashboardAdminController::class, 'subscriptionsStatus'])->name('dashboard.subscriptions.subscriptions-status');
            Route::get('/dashboard/subscriptions/new-subscriptions', [DashboardAdminController::class, 'newSubscriptions'])->name('dashboard.subscriptions.new-subscriptions');
            Route::get('/dashboard/subscriptions/latest-subscriptions', [DashboardAdminController::class, 'latestSubscriptions'])->name('dashboard.subscriptions.latest-subscriptions');
        });
    });
});