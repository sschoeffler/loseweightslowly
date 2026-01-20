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

    public function show(Request $request, Diet $diet, int $servings): View
    {
        $servings = max(1, min(6, $servings));

        $filters = [
            'cuisine' => $request->query('cuisine'),
            'max_prep_time' => $request->query('max_prep_time'),
            'budget' => $request->query('budget'),
            'meal_prep_friendly' => $request->boolean('meal_prep_friendly'),
            'exclude_allergens' => $request->query('exclude_allergens', []),
        ];

        $mealPlan = $this->mealPlanGenerator->generate($diet, $servings, $filters);

        return view('meal-plan', compact('mealPlan', 'filters'));
    }

    public function shoppingList(Request $request, Diet $diet, int $servings): View
    {
        $servings = max(1, min(6, $servings));

        $filters = [
            'cuisine' => $request->query('cuisine'),
            'max_prep_time' => $request->query('max_prep_time'),
            'budget' => $request->query('budget'),
            'meal_prep_friendly' => $request->boolean('meal_prep_friendly'),
            'exclude_allergens' => $request->query('exclude_allergens', []),
        ];

        $mealPlan = $this->mealPlanGenerator->generate($diet, $servings, $filters);
        $shoppingList = $this->shoppingListAggregator->aggregate($mealPlan, $servings);

        return view('shopping-list', [
            'diet' => $diet,
            'servings' => $servings,
            'shoppingList' => $shoppingList,
            'aggregator' => $this->shoppingListAggregator,
            'filters' => $filters,
        ]);
    }
}
