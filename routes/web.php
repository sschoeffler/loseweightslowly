<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\FastingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\OpenGraphImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipePreferenceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Public routes — viewable without login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/meal-plan/{diets}/{servings}', [MealPlanController::class, 'show'])->name('meal-plan')->where('diets', '[a-z0-9\-,]+');
Route::get('/shopping-list/{diets}/{servings}', [MealPlanController::class, 'shoppingList'])->name('shopping-list')->where('diets', '[a-z0-9\-,]+');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/og-image/recipe/{recipe}.png', [OpenGraphImageController::class, 'recipe'])->name('og-image.recipe');
Route::get('/og-image/default.png', [OpenGraphImageController::class, 'default'])->name('og-image.default');
Route::get('/fasting', [FastingController::class, 'index'])->name('fasting.index');
Route::get('/fasting/timer', [FastingController::class, 'timer'])->name('fasting.timer');
Route::get('/fasting/{slug}', [FastingController::class, 'plan'])->name('fasting.plan')->where('slug', '[a-z0-9\-]+');

// Privacy policy
Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/blog', function () {
    $posts = [];
    try {
        $response = \Illuminate\Support\Facades\Http::timeout(5)
            ->get('https://marketbreakthrough.com/api/blog/posts', ['site' => 'loseweightslowly.com']);
        if ($response->successful()) {
            $posts = $response->json();
        }
    } catch (\Exception $e) {
        // API unavailable — show empty state
    }
    return view('blog', ['posts' => $posts]);
})->name('blog');

// Authenticated routes — actions that modify data
Route::middleware('auth')->group(function () {
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
