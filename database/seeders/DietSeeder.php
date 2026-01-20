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
            [
                'name' => 'Kosher',
                'slug' => 'kosher',
                'description' => 'Follows Jewish dietary laws (kashrut). No pork or shellfish, meat and dairy separate, only kosher-certified ingredients.',
            ],
            [
                'name' => 'Halal',
                'slug' => 'halal',
                'description' => 'Follows Islamic dietary guidelines. No pork or alcohol, meat must be halal-certified, emphasizes wholesome ingredients.',
            ],
            [
                'name' => 'Vegan',
                'slug' => 'vegan',
                'description' => 'Strictly plant-based with no animal products including dairy, eggs, or honey. Rich in vegetables, fruits, grains, legumes, nuts, and seeds.',
            ],
            [
                'name' => 'Paleo',
                'slug' => 'paleo',
                'description' => 'Based on foods similar to those eaten during the Paleolithic era. No grains, legumes, dairy, or processed foods. Focus on meat, fish, vegetables, fruits, nuts.',
            ],
            [
                'name' => 'Whole30',
                'slug' => 'whole30',
                'description' => 'Elimination diet avoiding sugar, alcohol, grains, legumes, soy, and dairy for 30 days. Focus on whole, unprocessed foods.',
            ],
            [
                'name' => 'Low-FODMAP',
                'slug' => 'low-fodmap',
                'description' => 'Reduces fermentable carbs that can cause digestive issues. Avoids certain fruits, vegetables, grains, and dairy. Good for IBS management.',
            ],
            [
                'name' => 'Diabetic-Friendly',
                'slug' => 'diabetic-friendly',
                'description' => 'Low glycemic index foods to help manage blood sugar levels. Emphasizes lean proteins, non-starchy vegetables, and complex carbohydrates.',
            ],
            [
                'name' => 'Pescatarian',
                'slug' => 'pescatarian',
                'description' => 'Vegetarian diet that includes fish and seafood. No meat or poultry, but includes dairy, eggs, and all plant-based foods.',
            ],
        ];

        foreach ($diets as $diet) {
            Diet::create($diet);
        }
    }
}
