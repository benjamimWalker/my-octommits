<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('signin', [AuthController::class, 'loginRender'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('auth/callback', [AuthController::class, 'githubCallback']);
Route::get('auth/redirect', [AuthController::class, 'githubRedirect'])->name('auth-redirect');

Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
