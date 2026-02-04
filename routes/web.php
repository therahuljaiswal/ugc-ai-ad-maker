<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPromptController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Ad Routes
    Route::resource('ads', AdController::class);
    Route::get('/images/create', [ProductImageController::class, 'create'])->name('images.create');
    Route::post('/images', [ProductImageController::class, 'store'])->name('images.store');

    // Payment Routes
    Route::get('/buy-credits', [PaymentController::class, 'buyCredits'])->name('payments.buy-credits');
    Route::post('/payments/create-order', [PaymentController::class, 'createOrder'])->name('payments.create-order');
    Route::post('/payments/callback', [PaymentController::class, 'callback'])->name('payments.callback');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users/{user}/toggle-block', [AdminController::class, 'toggleBlock'])->name('users.toggle-block');
    Route::post('/users/{user}/give-credits', [AdminController::class, 'giveCredits'])->name('users.give-credits');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'saveSettings'])->name('settings.save');

    Route::resource('prompts', AdminPromptController::class);
});

require __DIR__.'/auth.php';
