<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CdrController;

Route::get('/', [WelcomeController::class, 'index']);
Route::group(['middleware' => 'auth'], function () {
Route::get('/cdr/list', [CdrController::class, 'index']);
});

Auth::routes();

