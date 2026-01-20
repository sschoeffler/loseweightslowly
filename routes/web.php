<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipePreferenceController;
use Illuminate\Support\Facades\Route;

// All main routes require authentication
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/meal-plan/{diet}/{servings}', [MealPlanController::class, 'show'])->name('meal-plan');
    Route::get('/shopping-list/{diet}/{servings}', [MealPlanController::class, 'shoppingList'])->name('shopping-list');

    // Chat routes
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/clear', [ChatController::class, 'clearHistory'])->name('chat.clear');

    // Recipe preference routes
    Route::post('/recipe/preference', [RecipePreferenceController::class, 'toggle'])->name('recipe.preference');
    Route::get('/recipe/preferences', [RecipePreferenceController::class, 'getUserPreferences'])->name('recipe.preferences');
    Route::post('/recipe/replacement', [RecipePreferenceController::class, 'getReplacement'])->name('recipe.replacement');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
