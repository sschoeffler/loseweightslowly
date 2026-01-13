<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DietSeeder::class,
            IngredientSeeder::class,
            RecipeSeeder::class,
        ]);
    }
}
