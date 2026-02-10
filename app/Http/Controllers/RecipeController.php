<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function show(Recipe $recipe): View
    {
        $recipe->load(['ingredients', 'diet', 'cuisine']);

        $relatedRecipes = Recipe::where('id', '!=', $recipe->id)
            ->where(function ($q) use ($recipe) {
                if ($recipe->cuisine_id) {
                    $q->where('cuisine_id', $recipe->cuisine_id);
                } else {
                    $q->where('diet_id', $recipe->diet_id)
                      ->where('meal_type', $recipe->meal_type);
                }
            })
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('recipe', compact('recipe', 'relatedRecipes'));
    }
}
