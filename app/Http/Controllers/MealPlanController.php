<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Services\MealPlanGenerator;
use App\Services\ShoppingListAggregator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MealPlanController extends Controller
{
    public function __construct(
        private MealPlanGenerator $mealPlanGenerator,
        private ShoppingListAggregator $shoppingListAggregator
    ) {}

    public function show(Request $request, string $diets, int $servings): View
    {
        $servings = max(1, min(6, $servings));

        // Parse comma-separated diet slugs and look up Diet models
        $dietSlugs = explode(',', $diets);
        $dietModels = Diet::whereIn('slug', $dietSlugs)->get();

        if ($dietModels->isEmpty()) {
            abort(404, 'No valid diets found');
        }

        $filters = [
            'cuisine' => $request->query('cuisine'),
            'max_prep_time' => $request->query('max_prep_time'),
            'budget' => $request->query('budget'),
            'meal_prep_friendly' => $request->boolean('meal_prep_friendly'),
            'exclude_allergens' => $request->query('exclude_allergens', []),
        ];

        $mealPlan = $this->mealPlanGenerator->generate($dietModels, $servings, $filters);

        return view('meal-plan', compact('mealPlan', 'filters'));
    }

    public function shoppingList(Request $request, string $diets, int $servings): View
    {
        $servings = max(1, min(6, $servings));

        // Parse comma-separated diet slugs and look up Diet models
        $dietSlugs = explode(',', $diets);
        $dietModels = Diet::whereIn('slug', $dietSlugs)->get();

        if ($dietModels->isEmpty()) {
            abort(404, 'No valid diets found');
        }

        $filters = [
            'cuisine' => $request->query('cuisine'),
            'max_prep_time' => $request->query('max_prep_time'),
            'budget' => $request->query('budget'),
            'meal_prep_friendly' => $request->boolean('meal_prep_friendly'),
            'exclude_allergens' => $request->query('exclude_allergens', []),
        ];

        $mealPlan = $this->mealPlanGenerator->generate($dietModels, $servings, $filters);
        $shoppingList = $this->shoppingListAggregator->aggregate($mealPlan, $servings);

        return view('shopping-list', [
            'diets' => $dietModels,
            'servings' => $servings,
            'shoppingList' => $shoppingList,
            'aggregator' => $this->shoppingListAggregator,
            'filters' => $filters,
        ]);
    }
}
