<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/meal-plan/{diet}/{servings}', [MealPlanController::class, 'show'])->name('meal-plan');
Route::get('/shopping-list/{diet}/{servings}', [MealPlanController::class, 'shoppingList'])->name('shopping-list');
