<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\UserRecipePreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipePreferenceController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'preference' => 'required|in:liked,disliked',
        ]);

        $userId = Auth::id();
        $recipeId = $request->recipe_id;
        $preference = $request->preference;

        $existing = UserRecipePreference::where('user_id', $userId)
            ->where('recipe_id', $recipeId)
            ->first();

        if ($existing) {
            if ($existing->preference === $preference) {
                $existing->delete();
                return response()->json(['status' => 'removed']);
            } else {
                $existing->update(['preference' => $preference]);
                return response()->json(['status' => 'updated', 'preference' => $preference]);
            }
        } else {
            UserRecipePreference::create([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
                'preference' => $preference,
            ]);
            return response()->json(['status' => 'created', 'preference' => $preference]);
        }
    }

    public function getUserPreferences()
    {
        $preferences = UserRecipePreference::where('user_id', Auth::id())
            ->pluck('preference', 'recipe_id');

        return response()->json($preferences);
    }

    public function getReplacement(Request $request)
    {
        $request->validate([
            'diet_id' => 'required|exists:diets,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'exclude_ids' => 'array',
            'exclude_ids.*' => 'integer',
            'servings' => 'integer|min:1|max:6',
        ]);

        $userId = Auth::id();
        $excludeIds = $request->input('exclude_ids', []);
        $servings = $request->input('servings', 2);

        // Get IDs of disliked recipes for this user
        $dislikedIds = UserRecipePreference::where('user_id', $userId)
            ->where('preference', 'disliked')
            ->pluck('recipe_id')
            ->toArray();

        // Merge excluded IDs with disliked IDs
        $allExcludedIds = array_unique(array_merge($excludeIds, $dislikedIds));

        // Find a replacement recipe
        $replacement = Recipe::where('diet_id', $request->diet_id)
            ->where('meal_type', $request->meal_type)
            ->whereNotIn('id', $allExcludedIds)
            ->with('ingredients')
            ->inRandomOrder()
            ->first();

        if (!$replacement) {
            return response()->json(['error' => 'No replacement recipes available'], 404);
        }

        // Format ingredients with scaled quantities
        $ingredients = $replacement->ingredients->map(function ($ingredient) use ($servings) {
            $qty = $ingredient->pivot->quantity * $servings;
            $unit = $ingredient->pivot->unit_override ?? $ingredient->unit;
            return [
                'name' => $ingredient->name,
                'quantity' => number_format($qty, $qty == floor($qty) ? 0 : 1),
                'unit' => $unit,
            ];
        });

        return response()->json([
            'id' => $replacement->id,
            'name' => $replacement->name,
            'prep_time' => $replacement->prep_time,
            'instructions' => $replacement->instructions,
            'calories' => $replacement->calories,
            'protein' => $replacement->protein,
            'carbs' => $replacement->carbs,
            'fat' => $replacement->fat,
            'ingredients' => $ingredients,
        ]);
    }
}
