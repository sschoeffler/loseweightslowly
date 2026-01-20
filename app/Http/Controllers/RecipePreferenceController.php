<?php

namespace App\Http\Controllers;

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
}
