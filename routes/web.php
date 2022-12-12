<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::get('{repo}/history', [RepoController::class, 'repo'])
    ->middleware('auth')
    ->name('repo');


require __DIR__ . '/auth.php';
