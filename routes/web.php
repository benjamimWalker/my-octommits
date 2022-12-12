<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

require __DIR__ . '/auth.php';
