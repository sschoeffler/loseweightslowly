<?php

namespace Database\Seeders;

use App\Models\Diet;
use Illuminate\Database\Seeder;

class DietSeeder extends Seeder
{
    public function run(): void
    {
        $diets = [
            [
                'name' => 'Mediterranean',
                'slug' => 'mediterranean',
                'description' => 'Heart-healthy diet rich in olive oil, fish, whole grains, legumes, and fresh vegetables. Emphasizes healthy fats and plant-based foods.',
            ],
            [
                'name' => 'Vegetarian',
                'slug' => 'vegetarian',
                'description' => 'Plant-based diet that excludes meat but includes dairy and eggs. Rich in vegetables, fruits, grains, legumes, nuts, and seeds.',
            ],
            [
                'name' => 'Keto',
                'slug' => 'keto',
                'description' => 'Very low-carbohydrate, high-fat diet that puts your body into ketosis. Focuses on proteins, healthy fats, and non-starchy vegetables.',
            ],
            [
                'name' => 'DASH',
                'slug' => 'dash',
                'description' => 'Dietary Approaches to Stop Hypertension. Low-sodium, heart-healthy diet rich in fruits, vegetables, whole grains, and lean proteins.',
            ],
            [
                'name' => 'Gluten-Free',
                'slug' => 'gluten-free',
                'description' => 'Eliminates all gluten-containing grains (wheat, barley, rye). Focuses on naturally gluten-free foods like rice, quinoa, meats, and vegetables.',
            ],
            [
                'name' => 'Lectin-Free',
                'slug' => 'lectin-free',
                'description' => 'Avoids foods high in lectins like beans, grains, and nightshades. Emphasizes pasture-raised meats, wild-caught fish, and leafy greens.',
            ],
        ];

        foreach ($diets as $diet) {
            Diet::create($diet);
        }
    }
}
