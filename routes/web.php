<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page.index');
});

Route::get('/login', function () {
    return view('landing-page.index');
});

Route::get('/subscription', function () {
    return view('subscription.index');
});
