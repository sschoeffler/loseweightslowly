<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use App\Services\MealPlanGenerator;
use App\Services\ShoppingListAggregator;
use Illuminate\View\View;

class MealPlanController extends Controller
{
    public function __construct(
        private MealPlanGenerator $mealPlanGenerator,
        private ShoppingListAggregator $shoppingListAggregator
    ) {}

    public function show(Diet $diet, int $servings): View
    {
        $servings = max(1, min(6, $servings));
        $mealPlan = $this->mealPlanGenerator->generate($diet, $servings);

        return view('meal-plan', compact('mealPlan'));
    }

    public function shoppingList(Diet $diet, int $servings): View
    {
        $servings = max(1, min(6, $servings));
        $mealPlan = $this->mealPlanGenerator->generate($diet, $servings);
        $shoppingList = $this->shoppingListAggregator->aggregate($mealPlan, $servings);

        return view('shopping-list', [
            'diet' => $diet,
            'servings' => $servings,
            'shoppingList' => $shoppingList,
            'aggregator' => $this->shoppingListAggregator,
        ]);
    }
}
