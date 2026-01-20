<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    public function run(): void
    {
        $allergens = [
            ['name' => 'Dairy', 'slug' => 'dairy', 'description' => 'Milk, cheese, butter, yogurt, and other dairy products'],
            ['name' => 'Eggs', 'slug' => 'eggs', 'description' => 'Eggs and egg-containing products'],
            ['name' => 'Tree Nuts', 'slug' => 'tree-nuts', 'description' => 'Almonds, walnuts, cashews, pecans, and other tree nuts'],
            ['name' => 'Peanuts', 'slug' => 'peanuts', 'description' => 'Peanuts and peanut-based products'],
            ['name' => 'Shellfish', 'slug' => 'shellfish', 'description' => 'Shrimp, crab, lobster, and other shellfish'],
            ['name' => 'Fish', 'slug' => 'fish', 'description' => 'Salmon, tuna, cod, and other fish'],
            ['name' => 'Soy', 'slug' => 'soy', 'description' => 'Soybeans, tofu, soy sauce, and soy-based products'],
            ['name' => 'Wheat', 'slug' => 'wheat', 'description' => 'Wheat and wheat-containing products'],
            ['name' => 'Gluten', 'slug' => 'gluten', 'description' => 'Wheat, barley, rye, and related grains'],
            ['name' => 'Sesame', 'slug' => 'sesame', 'description' => 'Sesame seeds and sesame-based products'],
        ];

        foreach ($allergens as $allergen) {
            Allergen::create($allergen);
        }
    }
}
