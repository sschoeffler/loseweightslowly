<?php

namespace App\Services;

use Illuminate\Support\Collection;

class ShoppingListAggregator
{
    public function aggregate(array $mealPlan, int $servings): array
    {
        $ingredients = collect();

        foreach ($mealPlan['days'] as $day => $meals) {
            foreach (['breakfast', 'lunch', 'dinner'] as $mealType) {
                $recipe = $meals[$mealType];
                if ($recipe) {
                    foreach ($recipe->ingredients as $ingredient) {
                        $key = $ingredient->id;
                        $quantity = $ingredient->pivot->quantity * $servings;
                        $unit = $ingredient->pivot->unit_override ?? $ingredient->unit;

                        if ($ingredients->has($key)) {
                            $existing = $ingredients->get($key);
                            $existing['quantity'] += $quantity;
                            $ingredients->put($key, $existing);
                        } else {
                            $ingredients->put($key, [
                                'name' => $ingredient->name,
                                'category' => $ingredient->category,
                                'quantity' => $quantity,
                                'unit' => $unit,
                            ]);
                        }
                    }
                }
            }
        }

        // Group by category and sort
        $grouped = $ingredients->values()->groupBy('category')->map(function ($items) {
            return $items->sortBy('name')->values();
        })->sortKeys();

        return $grouped->toArray();
    }

    public function formatQuantity(float $quantity, string $unit): string
    {
        // Convert oz to lb for large quantities
        if ($unit === 'oz' && $quantity >= 16) {
            $pounds = floor($quantity / 16);
            $remainingOz = $quantity % 16;
            if ($remainingOz == 0) {
                return $pounds . ' lb';
            }
            return $pounds . ' lb ' . round($remainingOz) . ' oz';
        }

        // Convert to readable fractions
        $fractions = [
            0.125 => '1/8',
            0.25 => '1/4',
            0.33 => '1/3',
            0.5 => '1/2',
            0.66 => '2/3',
            0.75 => '3/4',
        ];

        $whole = floor($quantity);
        $decimal = $quantity - $whole;

        $fractionPart = '';
        foreach ($fractions as $value => $display) {
            if (abs($decimal - $value) < 0.05) {
                $fractionPart = $display;
                break;
            }
        }

        if ($whole > 0 && $fractionPart) {
            $formatted = $whole . ' ' . $fractionPart;
        } elseif ($whole > 0) {
            $formatted = number_format($quantity, $decimal > 0 ? 1 : 0);
        } elseif ($fractionPart) {
            $formatted = $fractionPart;
        } else {
            $formatted = number_format($quantity, 1);
        }

        // Pluralize units if quantity > 1
        $pluralUnits = [
            'cup' => 'cups',
            'slice' => 'slices',
            'stalk' => 'stalks',
            'clove' => 'cloves',
            'head' => 'heads',
            'bunch' => 'bunches',
            'pint' => 'pints',
        ];

        if ($quantity > 1 && isset($pluralUnits[$unit])) {
            $unit = $pluralUnits[$unit];
        }

        return $formatted . ' ' . $unit;
    }
}
