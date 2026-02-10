<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Add slug column
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Generate slugs from recipe names
        $recipes = DB::table('recipes')->get();
        $usedSlugs = [];
        foreach ($recipes as $recipe) {
            $slug = Str::slug($recipe->name);
            // Handle duplicates by appending a number
            if (isset($usedSlugs[$slug])) {
                $usedSlugs[$slug]++;
                $slug .= '-' . $usedSlugs[$slug];
            } else {
                $usedSlugs[$slug] = 1;
            }
            DB::table('recipes')->where('id', $recipe->id)->update(['slug' => $slug]);
        }

        // Assign cuisine_id based on recipe name keywords
        $cuisineMap = DB::table('cuisines')->pluck('id', 'slug')->toArray();

        $patterns = [
            // Italian
            'italian' => [
                'Caprese', 'Eggplant Parmesan', 'Baked Chicken Parmesan', 'Risotto', 'Bolognese',
                'Baked Ziti', 'Ravioli', 'Stuffed Shells', 'Lasagna', 'Prosciutto',
                'Tuscan', 'Minestrone', 'Antipasto', 'Primavera', 'Pesto',
            ],
            // Greek
            'greek' => [
                'Greek Salad', 'Greek Omelet', 'Greek Chicken', 'Greek Mezze',
                'Greek Pasta', 'Greek-Style', 'Greek Yogurt', 'Souvlaki',
            ],
            // Mediterranean
            'mediterranean' => [
                'Mediterranean', 'Shakshuka', 'Falafel', 'Tabbouleh', 'Fattoush',
                'Stuffed Grape Leaves', 'Labneh', 'Moussaka', 'Seafood Paella',
                'Vegetable Paella', 'Hummus', 'Swordfish',
                'Grilled Octopus', 'Halloumi',
            ],
            // French
            'french' => [
                'Tuna Nicoise', 'Mussels in White Wine',
            ],
            // Mexican
            'mexican' => [
                'Tacos', 'Enchiladas', 'Huevos Rancheros', 'Burrito',
                'Taco Salad', 'Quesadilla',
            ],
            // Thai
            'thai' => [
                'Thai', 'Pad Thai',
            ],
            // Indian
            'indian' => [
                'Tikka Masala', 'Biryani', 'Tandoori',
            ],
            // Chinese
            'chinese' => [
                'Fried Rice', 'Kung Pao',
            ],
            // Middle Eastern
            'middle-eastern' => [
                'Shawarma', 'Kofta', 'Kebab', 'Fatayer', 'Burekas',
                'Arabic', 'Ful Medames', 'Foul with', 'Manakish',
                'Middle Eastern', 'Israeli', 'Baba Ganoush',
                'Fish with Tahini', 'Baked Fish with Tahini',
            ],
            // Moroccan
            'moroccan' => [
                'Tagine',
            ],
            // American
            'american' => [
                'BLT ', 'Cobb Salad', 'Buffalo Chicken', 'Burger',
                'Bacon Cheeseburger',
            ],
            // Korean
            'korean' => [
                'Bibimbap', 'Bulgogi', 'Kimchi',
            ],
            // Japanese
            'japanese' => [
                'Teriyaki', 'Miso',
            ],
        ];

        foreach ($patterns as $cuisineSlug => $keywords) {
            if (!isset($cuisineMap[$cuisineSlug])) continue;
            $cuisineId = $cuisineMap[$cuisineSlug];

            foreach ($keywords as $keyword) {
                DB::table('recipes')
                    ->whereNull('cuisine_id')
                    ->where('name', 'like', '%' . $keyword . '%')
                    ->update(['cuisine_id' => $cuisineId]);
            }
        }

        // Assign stir-fry dishes to Chinese cuisine (but not those already assigned)
        if (isset($cuisineMap['chinese'])) {
            DB::table('recipes')
                ->whereNull('cuisine_id')
                ->where('name', 'like', '%Stir-Fry%')
                ->update(['cuisine_id' => $cuisineMap['chinese']]);
            DB::table('recipes')
                ->whereNull('cuisine_id')
                ->where('name', 'like', '%Stir Fry%')
                ->update(['cuisine_id' => $cuisineMap['chinese']]);
        }

        // Assign curry dishes not already assigned to Indian
        if (isset($cuisineMap['indian'])) {
            DB::table('recipes')
                ->whereNull('cuisine_id')
                ->where('name', 'like', '%Curry%')
                ->update(['cuisine_id' => $cuisineMap['indian']]);
        }
    }

    public function down(): void
    {
        // Clear cuisine assignments
        DB::table('recipes')->update(['cuisine_id' => null]);

        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
