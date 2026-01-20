<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use Illuminate\Database\Seeder;

class CuisineSeeder extends Seeder
{
    public function run(): void
    {
        $cuisines = [
            // Asian
            ['name' => 'Chinese', 'slug' => 'chinese', 'category' => 'Asian', 'description' => 'Traditional Chinese cooking with stir-fries, dumplings, and rice dishes'],
            ['name' => 'Japanese', 'slug' => 'japanese', 'category' => 'Asian', 'description' => 'Japanese cuisine featuring sushi, ramen, and teriyaki'],
            ['name' => 'Thai', 'slug' => 'thai', 'category' => 'Asian', 'description' => 'Thai cooking with curries, pad thai, and bold flavors'],
            ['name' => 'Indian', 'slug' => 'indian', 'category' => 'Asian', 'description' => 'Indian cuisine with curries, tandoori, and aromatic spices'],
            ['name' => 'Vietnamese', 'slug' => 'vietnamese', 'category' => 'Asian', 'description' => 'Vietnamese dishes featuring pho, banh mi, and fresh herbs'],
            ['name' => 'Korean', 'slug' => 'korean', 'category' => 'Asian', 'description' => 'Korean cuisine with bibimbap, bulgogi, and fermented dishes'],

            // European
            ['name' => 'Italian', 'slug' => 'italian', 'category' => 'European', 'description' => 'Italian cooking with pasta, risotto, and Mediterranean flavors'],
            ['name' => 'French', 'slug' => 'french', 'category' => 'European', 'description' => 'Classic French cuisine with refined techniques and sauces'],
            ['name' => 'Mediterranean', 'slug' => 'mediterranean', 'category' => 'European', 'description' => 'Mediterranean dishes with olive oil, seafood, and fresh vegetables'],
            ['name' => 'Greek', 'slug' => 'greek', 'category' => 'European', 'description' => 'Greek cuisine with gyros, souvlaki, and feta'],

            // Americas
            ['name' => 'American', 'slug' => 'american', 'category' => 'Americas', 'description' => 'Classic American comfort food and modern cuisine'],
            ['name' => 'Mexican', 'slug' => 'mexican', 'category' => 'Americas', 'description' => 'Mexican dishes with tacos, enchiladas, and bold flavors'],
            ['name' => 'Southern', 'slug' => 'southern', 'category' => 'Americas', 'description' => 'Southern comfort food with fried chicken, BBQ, and soul food'],
            ['name' => 'Tex-Mex', 'slug' => 'tex-mex', 'category' => 'Americas', 'description' => 'Tex-Mex fusion with burritos, nachos, and cheese'],

            // Middle East & Africa
            ['name' => 'Middle Eastern', 'slug' => 'middle-eastern', 'category' => 'Middle East', 'description' => 'Middle Eastern cuisine with hummus, falafel, and kebabs'],
            ['name' => 'Moroccan', 'slug' => 'moroccan', 'category' => 'Middle East', 'description' => 'Moroccan tagines, couscous, and aromatic spices'],
        ];

        foreach ($cuisines as $cuisine) {
            Cuisine::create($cuisine);
        }
    }
}
