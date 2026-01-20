<?php

namespace App\Services;

use App\Models\Allergen;
use App\Models\Cuisine;
use App\Models\Diet;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class MealPlanGenerator
{
    public function generate(Diet $diet, int $servings, array $filters = []): array
    {
        $breakfasts = $this->getFilteredRecipes($diet, 'breakfast', $filters);
        $lunches = $this->getFilteredRecipes($diet, 'lunch', $filters);
        $dinners = $this->getFilteredRecipes($diet, 'dinner', $filters);

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
            'filters' => $filters,
        ];
    }

    private function getFilteredRecipes(Diet $diet, string $mealType, array $filters): Collection
    {
        $query = $diet->recipes()->where('meal_type', $mealType);

        try {
            // Filter by cuisine (only if cuisines table exists)
            if (!empty($filters['cuisine'])) {
                $cuisine = Cuisine::where('slug', $filters['cuisine'])->first();
                if ($cuisine) {
                    $query->where('cuisine_id', $cuisine->id);
                }
            }

            // Filter by max prep time
            if (!empty($filters['max_prep_time'])) {
                $query->where('prep_time', '<=', (int) $filters['max_prep_time']);
            }

            // Filter by budget level (only if column exists)
            if (!empty($filters['budget'])) {
                if (\Schema::hasColumn('recipes', 'budget_level')) {
                    $query->where('budget_level', $filters['budget']);
                }
            }

            // Filter by meal prep friendly (only if column exists)
            if (!empty($filters['meal_prep_friendly'])) {
                if (\Schema::hasColumn('recipes', 'is_meal_prep_friendly')) {
                    $query->where('is_meal_prep_friendly', true);
                }
            }

            // Exclude allergens (only if allergens table exists)
            if (!empty($filters['exclude_allergens']) && is_array($filters['exclude_allergens'])) {
                if (\Schema::hasTable('allergens')) {
                    $allergenIds = Allergen::whereIn('slug', $filters['exclude_allergens'])->pluck('id');
                    if ($allergenIds->isNotEmpty()) {
                        $query->whereDoesntHave('allergens', function (Builder $q) use ($allergenIds) {
                            $q->whereIn('allergens.id', $allergenIds);
                        });
                    }
                }
            }
        } catch (\Exception $e) {
            // If any filter fails, just return unfiltered recipes for this meal type
        }

        return $query->get();
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
