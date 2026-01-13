<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// All main routes require authentication
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/meal-plan/{diet}/{servings}', [MealPlanController::class, 'show'])->name('meal-plan');
    Route::get('/shopping-list/{diet}/{servings}', [MealPlanController::class, 'shoppingList'])->name('shopping-list');

    // Chat routes
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/clear', [ChatController::class, 'clearHistory'])->name('chat.clear');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
