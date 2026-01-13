<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            // Produce - Vegetables (standard units)
            ['name' => 'Spinach', 'category' => 'Produce', 'unit' => 'oz'],
            ['name' => 'Kale', 'category' => 'Produce', 'unit' => 'bunch'],
            ['name' => 'Mixed greens', 'category' => 'Produce', 'unit' => 'oz'],
            ['name' => 'Arugula', 'category' => 'Produce', 'unit' => 'oz'],
            ['name' => 'Broccoli', 'category' => 'Produce', 'unit' => 'head'],
            ['name' => 'Cauliflower', 'category' => 'Produce', 'unit' => 'head'],
            ['name' => 'Zucchini', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Bell pepper', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Tomatoes', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Cherry tomatoes', 'category' => 'Produce', 'unit' => 'pint'],
            ['name' => 'Cucumber', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Carrots', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Celery', 'category' => 'Produce', 'unit' => 'stalk'],
            ['name' => 'Onion', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Garlic', 'category' => 'Produce', 'unit' => 'clove'],
            ['name' => 'Mushrooms', 'category' => 'Produce', 'unit' => 'oz'],
            ['name' => 'Asparagus', 'category' => 'Produce', 'unit' => 'bunch'],
            ['name' => 'Green beans', 'category' => 'Produce', 'unit' => 'oz'],
            ['name' => 'Sweet potato', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Avocado', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Romaine lettuce', 'category' => 'Produce', 'unit' => 'head'],
            ['name' => 'Red onion', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Eggplant', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Cabbage', 'category' => 'Produce', 'unit' => 'head'],
            ['name' => 'Brussels sprouts', 'category' => 'Produce', 'unit' => 'oz'],

            // Produce - Fruits (standard units)
            ['name' => 'Lemon', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Lime', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Blueberries', 'category' => 'Produce', 'unit' => 'pint'],
            ['name' => 'Strawberries', 'category' => 'Produce', 'unit' => 'pint'],
            ['name' => 'Raspberries', 'category' => 'Produce', 'unit' => 'pint'],
            ['name' => 'Banana', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Apple', 'category' => 'Produce', 'unit' => 'medium'],
            ['name' => 'Orange', 'category' => 'Produce', 'unit' => 'medium'],

            // Proteins (weight-based)
            ['name' => 'Chicken breast', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Ground turkey', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Salmon fillet', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Shrimp', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Tuna', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Cod', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Ground beef', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Pork tenderloin', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Bacon', 'category' => 'Protein', 'unit' => 'slice'],
            ['name' => 'Eggs', 'category' => 'Protein', 'unit' => 'large'],
            ['name' => 'Tofu', 'category' => 'Protein', 'unit' => 'oz'],
            ['name' => 'Tempeh', 'category' => 'Protein', 'unit' => 'oz'],

            // Dairy
            ['name' => 'Greek yogurt', 'category' => 'Dairy', 'unit' => 'cup'],
            ['name' => 'Feta cheese', 'category' => 'Dairy', 'unit' => 'cup'],
            ['name' => 'Parmesan cheese', 'category' => 'Dairy', 'unit' => 'tbsp'],
            ['name' => 'Mozzarella cheese', 'category' => 'Dairy', 'unit' => 'cup'],
            ['name' => 'Cheddar cheese', 'category' => 'Dairy', 'unit' => 'cup'],
            ['name' => 'Cream cheese', 'category' => 'Dairy', 'unit' => 'tbsp'],
            ['name' => 'Heavy cream', 'category' => 'Dairy', 'unit' => 'cup'],
            ['name' => 'Milk', 'category' => 'Dairy', 'unit' => 'cup'],
            ['name' => 'Butter', 'category' => 'Dairy', 'unit' => 'tbsp'],
            ['name' => 'Cottage cheese', 'category' => 'Dairy', 'unit' => 'cup'],
            ['name' => 'Sour cream', 'category' => 'Dairy', 'unit' => 'tbsp'],
            ['name' => 'Goat cheese', 'category' => 'Dairy', 'unit' => 'cup'],

            // Grains
            ['name' => 'Brown rice', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Quinoa', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Oats', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Whole wheat bread', 'category' => 'Grains', 'unit' => 'slice'],
            ['name' => 'Whole wheat pasta', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Farro', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Bulgur', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Couscous', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Rice noodles', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Gluten-free oats', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Almond flour', 'category' => 'Grains', 'unit' => 'cup'],
            ['name' => 'Coconut flour', 'category' => 'Grains', 'unit' => 'cup'],

            // Legumes
            ['name' => 'Black beans', 'category' => 'Legumes', 'unit' => 'cup'],
            ['name' => 'Chickpeas', 'category' => 'Legumes', 'unit' => 'cup'],
            ['name' => 'Lentils', 'category' => 'Legumes', 'unit' => 'cup'],
            ['name' => 'Kidney beans', 'category' => 'Legumes', 'unit' => 'cup'],
            ['name' => 'White beans', 'category' => 'Legumes', 'unit' => 'cup'],
            ['name' => 'Edamame', 'category' => 'Legumes', 'unit' => 'cup'],

            // Nuts & Seeds
            ['name' => 'Almonds', 'category' => 'Nuts & Seeds', 'unit' => 'cup'],
            ['name' => 'Walnuts', 'category' => 'Nuts & Seeds', 'unit' => 'cup'],
            ['name' => 'Cashews', 'category' => 'Nuts & Seeds', 'unit' => 'cup'],
            ['name' => 'Pecans', 'category' => 'Nuts & Seeds', 'unit' => 'cup'],
            ['name' => 'Chia seeds', 'category' => 'Nuts & Seeds', 'unit' => 'tbsp'],
            ['name' => 'Flax seeds', 'category' => 'Nuts & Seeds', 'unit' => 'tbsp'],
            ['name' => 'Sunflower seeds', 'category' => 'Nuts & Seeds', 'unit' => 'tbsp'],
            ['name' => 'Pumpkin seeds', 'category' => 'Nuts & Seeds', 'unit' => 'tbsp'],
            ['name' => 'Pine nuts', 'category' => 'Nuts & Seeds', 'unit' => 'tbsp'],
            ['name' => 'Almond butter', 'category' => 'Nuts & Seeds', 'unit' => 'tbsp'],
            ['name' => 'Tahini', 'category' => 'Nuts & Seeds', 'unit' => 'tbsp'],

            // Pantry
            ['name' => 'Olive oil', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Coconut oil', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Avocado oil', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Balsamic vinegar', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Apple cider vinegar', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Red wine vinegar', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Soy sauce', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Coconut aminos', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Dijon mustard', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Honey', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Maple syrup', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Chicken broth', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Vegetable broth', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Diced tomatoes (canned)', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Tomato paste', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Coconut milk', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Almond milk', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Olives', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Capers', 'category' => 'Pantry', 'unit' => 'tbsp'],
            ['name' => 'Sun-dried tomatoes', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Artichoke hearts', 'category' => 'Pantry', 'unit' => 'cup'],
            ['name' => 'Hummus', 'category' => 'Pantry', 'unit' => 'cup'],

            // Herbs & Spices
            ['name' => 'Fresh basil', 'category' => 'Herbs & Spices', 'unit' => 'tbsp'],
            ['name' => 'Fresh cilantro', 'category' => 'Herbs & Spices', 'unit' => 'tbsp'],
            ['name' => 'Fresh parsley', 'category' => 'Herbs & Spices', 'unit' => 'tbsp'],
            ['name' => 'Fresh dill', 'category' => 'Herbs & Spices', 'unit' => 'tbsp'],
            ['name' => 'Fresh mint', 'category' => 'Herbs & Spices', 'unit' => 'tbsp'],
            ['name' => 'Fresh rosemary', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Fresh thyme', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Dried oregano', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Cumin', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Paprika', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Turmeric', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Cinnamon', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Ginger', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Red pepper flakes', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Black pepper', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Sea salt', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Italian seasoning', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
            ['name' => 'Chili powder', 'category' => 'Herbs & Spices', 'unit' => 'tsp'],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
