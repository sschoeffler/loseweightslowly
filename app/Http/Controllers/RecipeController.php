<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Models\Diet;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Recipe::with(['diet', 'cuisine']);

        if ($request->filled('diet')) {
            $query->whereHas('diet', fn ($q) => $q->where('slug', $request->diet));
        }

        if ($request->filled('cuisine')) {
            $query->whereHas('cuisine', fn ($q) => $q->where('slug', $request->cuisine));
        }

        if ($request->filled('meal_type')) {
            $query->where('meal_type', $request->meal_type);
        }

        $recipes = $query->orderBy('name')->paginate(18)->withQueryString();

        $diets = Diet::orderBy('name')->get();
        $cuisines = Cuisine::orderBy('name')->get();
        $mealTypes = ['breakfast', 'lunch', 'dinner'];

        return view('recipes.index', compact('recipes', 'diets', 'cuisines', 'mealTypes'));
    }

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
