<?php

namespace App\Services;

use App\Models\Diet;
use App\Models\Recipe;
use Illuminate\Support\Collection;

class MealPlanGenerator
{
    public function generate(Diet $diet, int $servings): array
    {
        $breakfasts = $diet->recipes()->where('meal_type', 'breakfast')->get();
        $lunches = $diet->recipes()->where('meal_type', 'lunch')->get();
        $dinners = $diet->recipes()->where('meal_type', 'dinner')->get();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $mealPlan = [];

        foreach ($days as $index => $day) {
            $mealPlan[$day] = [
                'breakfast' => $this->selectMeal($breakfasts, $index),
                'lunch' => $this->selectMeal($lunches, $index),
                'dinner' => $this->selectMeal($dinners, $index),
            ];
        }

        return [
            'diet' => $diet,
            'servings' => $servings,
            'days' => $mealPlan,
        ];
    }

    private function selectMeal(Collection $recipes, int $dayIndex): ?Recipe
    {
        if ($recipes->isEmpty()) {
            return null;
        }

        // Cycle through available recipes to ensure variety
        $index = $dayIndex % $recipes->count();
        $recipe = $recipes->values()->get($index);

        // Eager load ingredients for the selected recipe
        $recipe->load('ingredients');

        return $recipe;
    }
}
