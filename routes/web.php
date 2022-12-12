<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepoController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('{repo}/history', [RepoController::class, 'repo'])->name('repo');
});

require __DIR__ . '/auth.php';
