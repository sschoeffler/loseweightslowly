<?php

namespace Database\Seeders;

use App\Models\Diet;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    private array $ingredientCache = [];

    public function run(): void
    {
        $this->ingredientCache = Ingredient::pluck('id', 'name')->toArray();

        $this->seedMediterranean();
        $this->seedVegetarian();
        $this->seedKeto();
        $this->seedDash();
        $this->seedGlutenFree();
        $this->seedLectinFree();
        $this->seedKosher();
        $this->seedHalal();
        $this->seedVegan();
        $this->seedPaleo();
        $this->seedWhole30();
        $this->seedLowFodmap();
        $this->seedDiabeticFriendly();
        $this->seedPescatarian();
    }

    private function seedMediterranean(): void
    {
        $diet = Diet::where('slug', 'mediterranean')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Greek Yogurt Parfait', 'breakfast',
            'Layer Greek yogurt with fresh berries, honey, and a sprinkle of walnuts. Top with a drizzle of honey.', 10,
            ['Greek yogurt' => 1, 'Blueberries' => 0.5, 'Strawberries' => 0.5, 'Honey' => 1, 'Walnuts' => 0.25]);

        $this->createRecipe($diet, 'Mediterranean Eggs', 'breakfast',
            'Scramble eggs with spinach, tomatoes, and feta. Season with oregano and serve with whole grain toast.', 15,
            ['Eggs' => 2, 'Spinach' => 2, 'Cherry tomatoes' => 0.5, 'Feta cheese' => 0.25, 'Olive oil' => 1, 'Dried oregano' => 0.5]);

        $this->createRecipe($diet, 'Avocado Toast with Tomatoes', 'breakfast',
            'Toast whole grain bread and top with mashed avocado, sliced tomatoes, olive oil, and a sprinkle of sea salt.', 10,
            ['Whole wheat bread' => 2, 'Avocado' => 0.5, 'Tomatoes' => 1, 'Olive oil' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Oatmeal with Figs and Almonds', 'breakfast',
            'Cook oats and top with sliced almonds, a drizzle of honey, and cinnamon.', 10,
            ['Oats' => 0.5, 'Almonds' => 0.25, 'Honey' => 1, 'Cinnamon' => 0.5, 'Milk' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Greek Salad with Grilled Chicken', 'lunch',
            'Combine romaine, cucumbers, tomatoes, red onion, olives, and feta. Top with grilled chicken and olive oil dressing.', 20,
            ['Romaine lettuce' => 0.5, 'Cucumber' => 1, 'Cherry tomatoes' => 0.5, 'Red onion' => 0.25, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Chicken breast' => 6, 'Olive oil' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Hummus and Veggie Wrap', 'lunch',
            'Spread hummus on whole wheat wrap, add mixed greens, cucumber, tomatoes, and feta. Roll and enjoy.', 10,
            ['Hummus' => 0.5, 'Whole wheat bread' => 2, 'Mixed greens' => 2, 'Cucumber' => 0.5, 'Tomatoes' => 1, 'Feta cheese' => 0.25]);

        $this->createRecipe($diet, 'Lentil Soup', 'lunch',
            'Simmer lentils with diced tomatoes, carrots, celery, onion, and garlic. Season with cumin and serve with crusty bread.', 35,
            ['Lentils' => 1, 'Diced tomatoes (canned)' => 1, 'Carrots' => 2, 'Celery' => 3, 'Onion' => 1, 'Garlic' => 3, 'Cumin' => 1, 'Olive oil' => 1, 'Vegetable broth' => 2]);

        $this->createRecipe($diet, 'Tuna Salad Lettuce Wraps', 'lunch',
            'Mix tuna with olive oil, lemon juice, capers, and fresh herbs. Serve in crisp lettuce cups.', 15,
            ['Tuna' => 5, 'Olive oil' => 2, 'Lemon' => 0.5, 'Capers' => 1, 'Fresh parsley' => 1, 'Romaine lettuce' => 0.5]);

        // Dinners
        $this->createRecipe($diet, 'Grilled Salmon with Vegetables', 'dinner',
            'Grill salmon with olive oil and lemon. Serve with roasted zucchini, bell peppers, and cherry tomatoes.', 30,
            ['Salmon fillet' => 6, 'Olive oil' => 2, 'Lemon' => 1, 'Zucchini' => 1, 'Bell pepper' => 1, 'Cherry tomatoes' => 0.5, 'Fresh thyme' => 1, 'Sea salt' => 0.5]);

        $this->createRecipe($diet, 'Chicken Souvlaki Bowl', 'dinner',
            'Marinate chicken in olive oil, lemon, and oregano. Grill and serve over quinoa with cucumber, tomatoes, and tzatziki.', 35,
            ['Chicken breast' => 6, 'Quinoa' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Greek yogurt' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5, 'Dried oregano' => 1, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Shrimp with White Beans and Spinach', 'dinner',
            'Sauté shrimp with garlic, add white beans and spinach. Finish with lemon and fresh parsley.', 20,
            ['Shrimp' => 6, 'White beans' => 1, 'Spinach' => 4, 'Garlic' => 3, 'Olive oil' => 2, 'Lemon' => 0.5, 'Fresh parsley' => 1, 'Red pepper flakes' => 0.5]);

        $this->createRecipe($diet, 'Baked Cod with Tomatoes and Olives', 'dinner',
            'Bake cod with cherry tomatoes, olives, capers, and fresh herbs. Serve with a side of farro.', 25,
            ['Cod' => 6, 'Cherry tomatoes' => 1, 'Olives' => 0.25, 'Capers' => 1, 'Fresh basil' => 1, 'Olive oil' => 2, 'Farro' => 1]);

        // Additional Breakfasts
        $this->createRecipe($diet, 'Shakshuka', 'breakfast',
            'Poach eggs in spiced tomato sauce with bell peppers and onions. Serve with crusty bread.', 25,
            ['Eggs' => 2, 'Diced tomatoes (canned)' => 1, 'Bell pepper' => 0.5, 'Onion' => 0.5, 'Garlic' => 2, 'Cumin' => 0.5, 'Paprika' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Mediterranean Breakfast Plate', 'breakfast',
            'Arrange sliced tomatoes, cucumber, olives, feta, and a drizzle of olive oil. Serve with pita.', 10,
            ['Tomatoes' => 1, 'Cucumber' => 0.5, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Olive oil' => 1, 'Whole wheat bread' => 2]);

        $this->createRecipe($diet, 'Labneh with Za\'atar', 'breakfast',
            'Spread thick Greek yogurt on a plate, drizzle with olive oil, and sprinkle with herbs.', 5,
            ['Greek yogurt' => 1, 'Olive oil' => 2, 'Dried oregano' => 0.5, 'Sesame seeds' => 1]);

        $this->createRecipe($diet, 'Fig and Ricotta Toast', 'breakfast',
            'Toast whole grain bread, spread with ricotta, and top with honey and walnuts.', 10,
            ['Whole wheat bread' => 2, 'Ricotta cheese' => 0.5, 'Honey' => 1, 'Walnuts' => 0.25]);

        $this->createRecipe($diet, 'Spinach and Feta Frittata', 'breakfast',
            'Bake eggs with spinach, sun-dried tomatoes, and crumbled feta until golden.', 25,
            ['Eggs' => 3, 'Spinach' => 3, 'Sun-dried tomatoes' => 0.25, 'Feta cheese' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Tahini Date Oatmeal', 'breakfast',
            'Cook oats and stir in tahini and chopped dates. Top with almonds and cinnamon.', 10,
            ['Oats' => 0.5, 'Tahini' => 1, 'Almonds' => 0.25, 'Cinnamon' => 0.5, 'Milk' => 1]);

        $this->createRecipe($diet, 'Halloumi and Tomato Breakfast', 'breakfast',
            'Pan-fry halloumi slices until golden. Serve with fresh tomatoes and basil.', 15,
            ['Mozzarella cheese' => 0.5, 'Tomatoes' => 1, 'Fresh basil' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Greek Omelet', 'breakfast',
            'Fill omelet with olives, feta, and sun-dried tomatoes. Serve with whole grain toast.', 15,
            ['Eggs' => 3, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Sun-dried tomatoes' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Honey Walnut Greek Yogurt Bowl', 'breakfast',
            'Top thick Greek yogurt with honey, walnuts, and fresh mint.', 5,
            ['Greek yogurt' => 1, 'Honey' => 1, 'Walnuts' => 0.25, 'Fresh mint' => 1]);

        $this->createRecipe($diet, 'Olive Oil Fried Eggs', 'breakfast',
            'Fry eggs in generous olive oil until crispy. Serve with crusty bread and za\'atar.', 10,
            ['Eggs' => 2, 'Olive oil' => 2, 'Whole wheat bread' => 2, 'Sea salt' => 0.25]);

        // Additional Lunches
        $this->createRecipe($diet, 'Falafel Salad Bowl', 'lunch',
            'Serve baked falafel over mixed greens with cucumber, tomatoes, and tahini dressing.', 30,
            ['Chickpeas' => 1, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Tahini' => 2, 'Lemon' => 0.5, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Mediterranean Quinoa Salad', 'lunch',
            'Toss quinoa with cucumber, tomatoes, red onion, olives, and feta with lemon dressing.', 20,
            ['Quinoa' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Red onion' => 0.25, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Lemon' => 0.5, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Chicken Pita Sandwich', 'lunch',
            'Stuff whole wheat pita with grilled chicken, lettuce, tomatoes, and tzatziki sauce.', 20,
            ['Chicken breast' => 6, 'Whole wheat bread' => 2, 'Romaine lettuce' => 0.25, 'Tomatoes' => 1, 'Greek yogurt' => 0.25, 'Cucumber' => 0.25]);

        $this->createRecipe($diet, 'White Bean and Tuna Salad', 'lunch',
            'Mix white beans with tuna, red onion, parsley, and lemon olive oil dressing.', 15,
            ['White beans' => 1, 'Tuna' => 5, 'Red onion' => 0.25, 'Fresh parsley' => 1, 'Lemon' => 0.5, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Grilled Vegetable Panini', 'lunch',
            'Layer grilled zucchini, eggplant, and peppers on crusty bread with feta and pesto.', 25,
            ['Zucchini' => 1, 'Eggplant' => 0.5, 'Bell pepper' => 1, 'Feta cheese' => 0.25, 'Whole wheat bread' => 2, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Shrimp and Orzo Salad', 'lunch',
            'Toss cooked orzo with grilled shrimp, cucumber, dill, and lemon vinaigrette.', 25,
            ['Shrimp' => 6, 'Whole wheat pasta' => 1, 'Cucumber' => 0.5, 'Fresh dill' => 1, 'Lemon' => 0.5, 'Olive oil' => 2, 'Feta cheese' => 0.25]);

        $this->createRecipe($diet, 'Stuffed Grape Leaves Plate', 'lunch',
            'Serve stuffed grape leaves with hummus, tabbouleh, and pita bread.', 15,
            ['Brown rice' => 1, 'Fresh parsley' => 1, 'Fresh mint' => 1, 'Lemon' => 0.5, 'Olive oil' => 2, 'Hummus' => 0.5]);

        $this->createRecipe($diet, 'Mediterranean Chicken Wrap', 'lunch',
            'Wrap grilled chicken with hummus, mixed greens, cucumber, and roasted red peppers.', 20,
            ['Chicken breast' => 6, 'Whole wheat bread' => 2, 'Hummus' => 0.5, 'Mixed greens' => 2, 'Cucumber' => 0.5, 'Bell pepper' => 0.5]);

        $this->createRecipe($diet, 'Sardine and White Bean Toast', 'lunch',
            'Top crusty bread with mashed white beans, sardines, lemon, and fresh herbs.', 15,
            ['Tuna' => 5, 'White beans' => 0.5, 'Whole wheat bread' => 2, 'Lemon' => 0.5, 'Fresh parsley' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Greek Mezze Plate', 'lunch',
            'Arrange hummus, tzatziki, olives, feta, cucumber, and pita for a shared lunch.', 15,
            ['Hummus' => 0.5, 'Greek yogurt' => 0.5, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Cucumber' => 0.5, 'Whole wheat bread' => 2]);

        // Additional Dinners
        $this->createRecipe($diet, 'Lamb Kofta with Tzatziki', 'dinner',
            'Grill spiced lamb kofta and serve with tzatziki, pita, and Greek salad.', 30,
            ['Ground beef' => 6, 'Greek yogurt' => 0.5, 'Cucumber' => 0.5, 'Garlic' => 2, 'Cumin' => 0.5, 'Fresh mint' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Mediterranean Baked Fish', 'dinner',
            'Bake white fish with tomatoes, capers, olives, and fresh herbs. Serve with couscous.', 30,
            ['Cod' => 6, 'Cherry tomatoes' => 1, 'Capers' => 1, 'Olives' => 0.25, 'Fresh parsley' => 1, 'Olive oil' => 2, 'Farro' => 1]);

        $this->createRecipe($diet, 'Chicken with Artichokes and Olives', 'dinner',
            'Braise chicken thighs with artichoke hearts, olives, and white wine.', 40,
            ['Chicken breast' => 8, 'Olives' => 0.25, 'Garlic' => 3, 'Chicken broth' => 1, 'Lemon' => 0.5, 'Fresh rosemary' => 1, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Stuffed Zucchini Boats', 'dinner',
            'Fill zucchini halves with quinoa, tomatoes, feta, and herbs. Bake until tender.', 35,
            ['Zucchini' => 2, 'Quinoa' => 1, 'Cherry tomatoes' => 0.5, 'Feta cheese' => 0.25, 'Fresh basil' => 1, 'Olive oil' => 1, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Grilled Octopus with Lemon', 'dinner',
            'Grill tender octopus with olive oil and lemon. Serve with roasted potatoes and greens.', 45,
            ['Shrimp' => 8, 'Olive oil' => 3, 'Lemon' => 1, 'Garlic' => 3, 'Fresh parsley' => 1, 'Quinoa' => 1]);

        $this->createRecipe($diet, 'Moussaka', 'dinner',
            'Layer eggplant with spiced meat sauce and top with béchamel. Bake until golden.', 60,
            ['Eggplant' => 1, 'Ground beef' => 6, 'Diced tomatoes (canned)' => 1, 'Onion' => 0.5, 'Garlic' => 2, 'Cinnamon' => 0.5, 'Milk' => 1, 'Butter' => 2]);

        $this->createRecipe($diet, 'Lemon Herb Roasted Chicken', 'dinner',
            'Roast whole chicken with lemon, garlic, and Mediterranean herbs. Serve with roasted vegetables.', 60,
            ['Chicken breast' => 8, 'Lemon' => 1, 'Garlic' => 4, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Olive oil' => 2, 'Carrots' => 2, 'Onion' => 1]);

        $this->createRecipe($diet, 'Seafood Paella', 'dinner',
            'Cook rice with saffron, shrimp, and vegetables in a traditional paella style.', 45,
            ['Brown rice' => 1, 'Shrimp' => 6, 'Bell pepper' => 1, 'Onion' => 0.5, 'Garlic' => 3, 'Chicken broth' => 2, 'Turmeric' => 0.5, 'Fresh parsley' => 1]);

        $this->createRecipe($diet, 'Greek-Style Roasted Vegetables', 'dinner',
            'Roast eggplant, zucchini, tomatoes with feta and herbs. Serve with warm pita.', 40,
            ['Eggplant' => 0.5, 'Zucchini' => 1, 'Cherry tomatoes' => 1, 'Feta cheese' => 0.5, 'Olive oil' => 2, 'Dried oregano' => 0.5, 'Whole wheat bread' => 2]);

        $this->createRecipe($diet, 'Swordfish Steaks with Herbs', 'dinner',
            'Grill swordfish steaks with olive oil, oregano, and lemon. Serve with quinoa salad.', 25,
            ['Salmon fillet' => 6, 'Olive oil' => 2, 'Lemon' => 1, 'Dried oregano' => 0.5, 'Quinoa' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5]);
    }

    private function seedVegetarian(): void
    {
        $diet = Diet::where('slug', 'vegetarian')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Veggie Scramble', 'breakfast',
            'Scramble eggs with bell peppers, onions, spinach, and mushrooms. Top with shredded cheese.', 15,
            ['Eggs' => 2, 'Bell pepper' => 0.5, 'Onion' => 0.25, 'Spinach' => 2, 'Mushrooms' => 4, 'Cheddar cheese' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Berry Smoothie Bowl', 'breakfast',
            'Blend frozen berries with Greek yogurt and almond milk. Top with granola, chia seeds, and fresh fruit.', 10,
            ['Blueberries' => 0.5, 'Strawberries' => 0.5, 'Greek yogurt' => 0.5, 'Almond milk' => 0.5, 'Chia seeds' => 1, 'Banana' => 0.5]);

        $this->createRecipe($diet, 'Cottage Cheese Pancakes', 'breakfast',
            'Blend cottage cheese, eggs, and oats. Cook as pancakes and serve with fresh berries and maple syrup.', 20,
            ['Cottage cheese' => 1, 'Eggs' => 2, 'Oats' => 0.5, 'Blueberries' => 0.5, 'Maple syrup' => 1]);

        $this->createRecipe($diet, 'Avocado Egg Cups', 'breakfast',
            'Halve avocados, remove some flesh, crack an egg into each half. Bake until set.', 25,
            ['Avocado' => 1, 'Eggs' => 2, 'Sea salt' => 0.25, 'Black pepper' => 0.25, 'Fresh cilantro' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Quinoa Buddha Bowl', 'lunch',
            'Arrange quinoa, roasted chickpeas, avocado, cucumber, and mixed greens. Drizzle with tahini dressing.', 25,
            ['Quinoa' => 1, 'Chickpeas' => 0.5, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Mixed greens' => 3, 'Tahini' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Caprese Salad with Quinoa', 'lunch',
            'Layer fresh mozzarella, tomatoes, and basil over quinoa. Drizzle with balsamic and olive oil.', 15,
            ['Mozzarella cheese' => 0.5, 'Tomatoes' => 2, 'Fresh basil' => 2, 'Quinoa' => 1, 'Balsamic vinegar' => 1, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Black Bean Tacos', 'lunch',
            'Fill corn tortillas with seasoned black beans, avocado, salsa, and fresh cilantro.', 20,
            ['Black beans' => 1, 'Avocado' => 0.5, 'Tomatoes' => 1, 'Fresh cilantro' => 1, 'Lime' => 0.5, 'Cumin' => 0.5, 'Sour cream' => 2]);

        $this->createRecipe($diet, 'Vegetable Stir-Fry', 'lunch',
            'Stir-fry tofu with broccoli, bell peppers, and snap peas in soy sauce. Serve over rice.', 25,
            ['Tofu' => 8, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Soy sauce' => 2, 'Brown rice' => 1, 'Garlic' => 2, 'Ginger' => 0.5]);

        // Dinners
        $this->createRecipe($diet, 'Eggplant Parmesan', 'dinner',
            'Bread and bake eggplant slices, layer with marinara and mozzarella. Bake until bubbly.', 45,
            ['Eggplant' => 1, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.5, 'Parmesan cheese' => 2, 'Fresh basil' => 1, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Stuffed Bell Peppers', 'dinner',
            'Fill bell peppers with quinoa, black beans, corn, and cheese. Bake until tender.', 40,
            ['Bell pepper' => 2, 'Quinoa' => 1, 'Black beans' => 0.5, 'Tomatoes' => 1, 'Cheddar cheese' => 0.5, 'Cumin' => 0.5]);

        $this->createRecipe($diet, 'Mushroom Risotto', 'dinner',
            'Cook arborio rice slowly with vegetable broth, sautéed mushrooms, and parmesan. Finish with butter.', 40,
            ['Brown rice' => 1, 'Mushrooms' => 8, 'Vegetable broth' => 3, 'Parmesan cheese' => 2, 'Butter' => 2, 'Onion' => 0.5, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Lentil Curry', 'dinner',
            'Simmer lentils in coconut milk with curry spices, tomatoes, and spinach. Serve over rice.', 35,
            ['Lentils' => 1, 'Coconut milk' => 1, 'Diced tomatoes (canned)' => 1, 'Spinach' => 3, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Ginger' => 0.5, 'Brown rice' => 1]);

        // Additional Breakfasts
        $this->createRecipe($diet, 'Banana Nut Oatmeal', 'breakfast',
            'Cook oats with sliced banana, walnuts, and a drizzle of maple syrup.', 10,
            ['Oats' => 0.5, 'Banana' => 1, 'Walnuts' => 0.25, 'Maple syrup' => 1, 'Milk' => 1]);

        $this->createRecipe($diet, 'Spinach and Mushroom Frittata', 'breakfast',
            'Bake eggs with spinach, mushrooms, and goat cheese until set.', 25,
            ['Eggs' => 3, 'Spinach' => 2, 'Mushrooms' => 4, 'Goat cheese' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Peanut Butter Banana Toast', 'breakfast',
            'Spread peanut butter on whole grain toast and top with sliced banana and honey.', 5,
            ['Whole wheat bread' => 2, 'Peanut butter' => 2, 'Banana' => 0.5, 'Honey' => 1]);

        $this->createRecipe($diet, 'Tropical Smoothie', 'breakfast',
            'Blend mango, pineapple, banana, and coconut milk for a tropical start.', 5,
            ['Banana' => 0.5, 'Coconut milk' => 1, 'Greek yogurt' => 0.5, 'Honey' => 1]);

        $this->createRecipe($diet, 'Cheese and Herb Scramble', 'breakfast',
            'Scramble eggs with fresh herbs, chives, and melted cheddar cheese.', 10,
            ['Eggs' => 2, 'Cheddar cheese' => 0.25, 'Fresh parsley' => 1, 'Butter' => 1]);

        $this->createRecipe($diet, 'Overnight Oats with Berries', 'breakfast',
            'Soak oats overnight in milk with chia seeds. Top with fresh berries.', 5,
            ['Oats' => 0.5, 'Milk' => 1, 'Chia seeds' => 1, 'Blueberries' => 0.5, 'Strawberries' => 0.5]);

        $this->createRecipe($diet, 'Ricotta Stuffed French Toast', 'breakfast',
            'Make French toast stuffed with sweetened ricotta. Top with fresh berries.', 20,
            ['Whole wheat bread' => 2, 'Ricotta cheese' => 0.5, 'Eggs' => 2, 'Milk' => 0.25, 'Blueberries' => 0.5, 'Maple syrup' => 1]);

        $this->createRecipe($diet, 'Green Power Smoothie', 'breakfast',
            'Blend spinach, banana, almond butter, and almond milk until smooth.', 5,
            ['Spinach' => 2, 'Banana' => 1, 'Almond butter' => 1, 'Almond milk' => 1, 'Honey' => 1]);

        $this->createRecipe($diet, 'Huevos Rancheros', 'breakfast',
            'Serve fried eggs over corn tortillas with black beans and salsa.', 20,
            ['Eggs' => 2, 'Black beans' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Fresh cilantro' => 1, 'Lime' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Almond Butter Banana Wrap', 'breakfast',
            'Spread almond butter on a whole wheat wrap, add sliced banana, and roll up.', 5,
            ['Whole wheat bread' => 2, 'Almond butter' => 2, 'Banana' => 1, 'Honey' => 1]);

        // Additional Lunches
        $this->createRecipe($diet, 'Mediterranean Veggie Wrap', 'lunch',
            'Fill wrap with hummus, falafel, mixed greens, tomatoes, and tzatziki.', 20,
            ['Whole wheat bread' => 2, 'Hummus' => 0.5, 'Chickpeas' => 0.5, 'Mixed greens' => 2, 'Tomatoes' => 1, 'Greek yogurt' => 0.25]);

        $this->createRecipe($diet, 'Tomato Basil Soup with Grilled Cheese', 'lunch',
            'Make creamy tomato soup and serve with a classic grilled cheese sandwich.', 30,
            ['Diced tomatoes (canned)' => 1, 'Vegetable broth' => 1, 'Fresh basil' => 1, 'Whole wheat bread' => 2, 'Cheddar cheese' => 0.5, 'Butter' => 1]);

        $this->createRecipe($diet, 'Greek Pasta Salad', 'lunch',
            'Toss pasta with cucumber, tomatoes, olives, feta, and Greek dressing.', 20,
            ['Whole wheat pasta' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Olive oil' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Spinach and Artichoke Quesadilla', 'lunch',
            'Fill tortilla with spinach, artichokes, and melted cheese. Serve with salsa.', 15,
            ['Whole wheat bread' => 2, 'Spinach' => 2, 'Mozzarella cheese' => 0.5, 'Cream cheese' => 2, 'Garlic' => 1]);

        $this->createRecipe($diet, 'Asian Noodle Salad', 'lunch',
            'Toss rice noodles with edamame, carrots, cabbage, and sesame ginger dressing.', 20,
            ['Rice noodles' => 1, 'Carrots' => 2, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Sesame seeds' => 1, 'Fresh cilantro' => 1]);

        $this->createRecipe($diet, 'Loaded Sweet Potato', 'lunch',
            'Bake sweet potato and top with black beans, cheese, sour cream, and green onions.', 45,
            ['Sweet potato' => 1, 'Black beans' => 0.5, 'Cheddar cheese' => 0.25, 'Sour cream' => 2, 'Fresh cilantro' => 1]);

        $this->createRecipe($diet, 'Minestrone Soup', 'lunch',
            'Simmer vegetables, beans, and pasta in tomato broth with Italian herbs.', 40,
            ['Diced tomatoes (canned)' => 1, 'White beans' => 0.5, 'Whole wheat pasta' => 0.5, 'Carrots' => 2, 'Celery' => 2, 'Vegetable broth' => 2, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Avocado Black Bean Salad', 'lunch',
            'Toss black beans with avocado, corn, tomatoes, and lime cilantro dressing.', 15,
            ['Black beans' => 1, 'Avocado' => 0.5, 'Cherry tomatoes' => 0.5, 'Fresh cilantro' => 1, 'Lime' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Vegetable Fried Rice', 'lunch',
            'Stir-fry rice with mixed vegetables, eggs, and soy sauce.', 20,
            ['Brown rice' => 1, 'Eggs' => 2, 'Carrots' => 1, 'Bell pepper' => 0.5, 'Soy sauce' => 1, 'Garlic' => 2, 'Ginger' => 0.5]);

        $this->createRecipe($diet, 'Chickpea Salad Sandwich', 'lunch',
            'Mash chickpeas with mayo and spices. Serve on bread with lettuce and tomato.', 15,
            ['Chickpeas' => 1, 'Greek yogurt' => 0.25, 'Dijon mustard' => 0.5, 'Whole wheat bread' => 2, 'Romaine lettuce' => 0.25, 'Tomatoes' => 1]);

        // Additional Dinners
        $this->createRecipe($diet, 'Vegetable Lasagna', 'dinner',
            'Layer pasta with ricotta, spinach, mushrooms, and marinara. Bake until bubbly.', 60,
            ['Whole wheat pasta' => 1, 'Ricotta cheese' => 1, 'Spinach' => 3, 'Mushrooms' => 4, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.5, 'Parmesan cheese' => 2]);

        $this->createRecipe($diet, 'Thai Coconut Curry', 'dinner',
            'Simmer tofu and vegetables in coconut curry sauce. Serve over jasmine rice.', 30,
            ['Tofu' => 8, 'Coconut milk' => 1, 'Bell pepper' => 1, 'Broccoli' => 0.5, 'Brown rice' => 1, 'Ginger' => 0.5, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Portobello Mushroom Burgers', 'dinner',
            'Grill marinated portobello caps and serve on buns with all the fixings.', 25,
            ['Mushrooms' => 4, 'Whole wheat bread' => 2, 'Avocado' => 0.5, 'Tomatoes' => 1, 'Mixed greens' => 1, 'Balsamic vinegar' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Spinach and Ricotta Stuffed Shells', 'dinner',
            'Fill jumbo pasta shells with spinach and ricotta. Bake in marinara sauce.', 45,
            ['Whole wheat pasta' => 1, 'Ricotta cheese' => 1, 'Spinach' => 3, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.5, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Vegetable Pad Thai', 'dinner',
            'Stir-fry rice noodles with tofu, vegetables, eggs, and pad thai sauce.', 30,
            ['Rice noodles' => 1, 'Tofu' => 6, 'Eggs' => 2, 'Bean sprouts' => 1, 'Peanut butter' => 1, 'Soy sauce' => 1, 'Lime' => 0.5]);

        $this->createRecipe($diet, 'Black Bean Enchiladas', 'dinner',
            'Roll black beans and cheese in tortillas. Top with enchilada sauce and bake.', 40,
            ['Black beans' => 1, 'Cheddar cheese' => 0.5, 'Whole wheat bread' => 2, 'Diced tomatoes (canned)' => 1, 'Cumin' => 0.5, 'Sour cream' => 2, 'Fresh cilantro' => 1]);

        $this->createRecipe($diet, 'Cauliflower Tikka Masala', 'dinner',
            'Roast cauliflower and simmer in creamy tikka masala sauce. Serve with rice.', 40,
            ['Cauliflower' => 0.5, 'Diced tomatoes (canned)' => 1, 'Coconut milk' => 0.5, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Ginger' => 0.5, 'Brown rice' => 1]);

        $this->createRecipe($diet, 'Baked Ziti', 'dinner',
            'Mix pasta with ricotta and marinara. Top with mozzarella and bake.', 45,
            ['Whole wheat pasta' => 1, 'Ricotta cheese' => 0.5, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.5, 'Parmesan cheese' => 2, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Vegetable Biryani', 'dinner',
            'Layer spiced rice with mixed vegetables and cook until fragrant.', 45,
            ['Brown rice' => 1, 'Cauliflower' => 0.25, 'Carrots' => 2, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Cinnamon' => 0.25, 'Greek yogurt' => 0.25, 'Fresh cilantro' => 1]);

        $this->createRecipe($diet, 'Cheese Ravioli with Sage Butter', 'dinner',
            'Cook cheese ravioli and toss with brown butter and crispy sage leaves.', 20,
            ['Whole wheat pasta' => 1, 'Ricotta cheese' => 0.5, 'Butter' => 3, 'Parmesan cheese' => 2, 'Garlic' => 1]);
    }

    private function seedKeto(): void
    {
        $diet = Diet::where('slug', 'keto')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Bacon and Eggs', 'breakfast',
            'Fry bacon until crispy. Cook eggs in the bacon fat. Serve with sliced avocado.', 15,
            ['Bacon' => 4, 'Eggs' => 3, 'Avocado' => 0.5, 'Sea salt' => 0.25, 'Black pepper' => 0.25]);

        $this->createRecipe($diet, 'Keto Egg Muffins', 'breakfast',
            'Mix eggs with cheese, spinach, and bacon. Pour into muffin tins and bake until set.', 30,
            ['Eggs' => 4, 'Cheddar cheese' => 0.5, 'Spinach' => 2, 'Bacon' => 2, 'Heavy cream' => 0.25]);

        $this->createRecipe($diet, 'Cream Cheese Pancakes', 'breakfast',
            'Blend cream cheese, eggs, and almond flour. Cook as thin pancakes. Serve with butter.', 20,
            ['Cream cheese' => 4, 'Eggs' => 2, 'Almond flour' => 0.25, 'Butter' => 2, 'Cinnamon' => 0.5]);

        $this->createRecipe($diet, 'Smoked Salmon Plate', 'breakfast',
            'Arrange smoked salmon with cream cheese, capers, and sliced cucumber.', 10,
            ['Salmon fillet' => 4, 'Cream cheese' => 2, 'Capers' => 1, 'Cucumber' => 0.5, 'Fresh dill' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Cobb Salad', 'lunch',
            'Top mixed greens with grilled chicken, bacon, eggs, avocado, blue cheese, and ranch dressing.', 20,
            ['Mixed greens' => 4, 'Chicken breast' => 6, 'Bacon' => 2, 'Eggs' => 2, 'Avocado' => 0.5, 'Goat cheese' => 0.25, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Tuna Stuffed Avocados', 'lunch',
            'Mix tuna with mayo and celery. Stuff into avocado halves. Season with lemon.', 15,
            ['Tuna' => 5, 'Avocado' => 1, 'Celery' => 2, 'Lemon' => 0.5, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Burger Lettuce Wraps', 'lunch',
            'Grill beef patties, wrap in large lettuce leaves with cheese, tomato, and mustard.', 20,
            ['Ground beef' => 6, 'Romaine lettuce' => 0.5, 'Cheddar cheese' => 0.25, 'Tomatoes' => 1, 'Dijon mustard' => 1]);

        $this->createRecipe($diet, 'Chicken Caesar Salad (No Croutons)', 'lunch',
            'Toss romaine with grilled chicken, parmesan, and creamy caesar dressing.', 15,
            ['Romaine lettuce' => 0.5, 'Chicken breast' => 6, 'Parmesan cheese' => 2, 'Olive oil' => 2, 'Lemon' => 0.5, 'Garlic' => 1]);

        // Dinners
        $this->createRecipe($diet, 'Steak with Garlic Butter Asparagus', 'dinner',
            'Pan-sear steak to desired doneness. Sauté asparagus in garlic butter. Serve together.', 25,
            ['Ground beef' => 8, 'Asparagus' => 1, 'Butter' => 3, 'Garlic' => 3, 'Fresh rosemary' => 1, 'Sea salt' => 0.5]);

        $this->createRecipe($diet, 'Creamy Tuscan Chicken', 'dinner',
            'Pan-fry chicken, make cream sauce with sun-dried tomatoes, spinach, and parmesan.', 30,
            ['Chicken breast' => 6, 'Heavy cream' => 0.5, 'Sun-dried tomatoes' => 0.25, 'Spinach' => 3, 'Parmesan cheese' => 2, 'Garlic' => 2, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Baked Salmon with Broccoli', 'dinner',
            'Bake salmon with lemon and dill. Roast broccoli with olive oil and garlic.', 25,
            ['Salmon fillet' => 6, 'Broccoli' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5, 'Fresh dill' => 1, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Pork Chops with Cauliflower Mash', 'dinner',
            'Pan-sear pork chops. Make creamy cauliflower mash with butter and cream.', 30,
            ['Pork tenderloin' => 6, 'Cauliflower' => 0.5, 'Butter' => 2, 'Heavy cream' => 0.25, 'Garlic' => 1, 'Fresh thyme' => 1]);

        // Additional Breakfasts
        $this->createRecipe($diet, 'Cheese Omelet', 'breakfast',
            'Make a fluffy omelet filled with cheddar and topped with sour cream.', 10,
            ['Eggs' => 3, 'Cheddar cheese' => 0.5, 'Butter' => 1, 'Sour cream' => 2]);

        $this->createRecipe($diet, 'Avocado Bacon Boats', 'breakfast',
            'Fill avocado halves with crumbled bacon and a drizzle of ranch.', 15,
            ['Avocado' => 1, 'Bacon' => 3, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Sausage and Cheese Casserole', 'breakfast',
            'Bake sausage with eggs, cheese, and cream until puffed and golden.', 35,
            ['Pork tenderloin' => 4, 'Eggs' => 4, 'Cheddar cheese' => 0.5, 'Heavy cream' => 0.25]);

        $this->createRecipe($diet, 'Ham and Cheese Roll-Ups', 'breakfast',
            'Roll sliced ham around cream cheese and chives. Quick and portable.', 5,
            ['Pork tenderloin' => 4, 'Cream cheese' => 2, 'Fresh parsley' => 1]);

        $this->createRecipe($diet, 'Keto Coffee', 'breakfast',
            'Blend hot coffee with butter and coconut oil for a creamy keto drink. Serve with eggs.', 10,
            ['Butter' => 2, 'Coconut milk' => 0.25, 'Eggs' => 2]);

        $this->createRecipe($diet, 'Zucchini Fritters', 'breakfast',
            'Mix shredded zucchini with eggs and cheese. Pan-fry until golden.', 20,
            ['Zucchini' => 1, 'Eggs' => 2, 'Parmesan cheese' => 2, 'Almond flour' => 0.25, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Caprese Egg Cups', 'breakfast',
            'Bake eggs with mozzarella, tomatoes, and fresh basil in muffin tins.', 25,
            ['Eggs' => 3, 'Mozzarella cheese' => 0.5, 'Cherry tomatoes' => 0.5, 'Fresh basil' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Almond Flour Waffles', 'breakfast',
            'Make low-carb waffles with almond flour, eggs, and cream cheese.', 20,
            ['Almond flour' => 0.5, 'Eggs' => 2, 'Cream cheese' => 2, 'Butter' => 2]);

        $this->createRecipe($diet, 'Prosciutto Wrapped Asparagus', 'breakfast',
            'Wrap asparagus spears in prosciutto and bake until crispy. Serve with eggs.', 20,
            ['Asparagus' => 0.5, 'Bacon' => 3, 'Eggs' => 2, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Spinach Cream Cheese Eggs', 'breakfast',
            'Scramble eggs with cream cheese and wilted spinach.', 10,
            ['Eggs' => 3, 'Cream cheese' => 2, 'Spinach' => 2, 'Butter' => 1]);

        // Additional Lunches
        $this->createRecipe($diet, 'BLT Lettuce Wrap', 'lunch',
            'Wrap crispy bacon, tomatoes, and mayo in large lettuce leaves.', 15,
            ['Bacon' => 4, 'Tomatoes' => 1, 'Romaine lettuce' => 0.5, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Egg Salad Stuffed Avocado', 'lunch',
            'Fill avocado halves with creamy egg salad made with mayo and mustard.', 15,
            ['Eggs' => 3, 'Avocado' => 1, 'Dijon mustard' => 0.5, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Antipasto Salad', 'lunch',
            'Arrange salami, mozzarella, olives, and roasted peppers over greens.', 10,
            ['Mixed greens' => 3, 'Pork tenderloin' => 4, 'Mozzarella cheese' => 0.5, 'Olives' => 0.25, 'Bell pepper' => 0.5, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Cauliflower Mac and Cheese', 'lunch',
            'Bake cauliflower florets in creamy cheddar cheese sauce.', 30,
            ['Cauliflower' => 0.5, 'Cheddar cheese' => 0.5, 'Heavy cream' => 0.5, 'Butter' => 2, 'Garlic' => 1]);

        $this->createRecipe($diet, 'Greek Salad (No Pita)', 'lunch',
            'Toss cucumber, tomatoes, olives, and feta with olive oil dressing.', 10,
            ['Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Olive oil' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Buffalo Chicken Salad', 'lunch',
            'Toss grilled chicken with buffalo sauce over romaine with blue cheese.', 20,
            ['Chicken breast' => 6, 'Romaine lettuce' => 0.5, 'Goat cheese' => 0.25, 'Celery' => 2, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Zucchini Noodle Salad', 'lunch',
            'Spiralize zucchini and toss with pesto, sun-dried tomatoes, and parmesan.', 15,
            ['Zucchini' => 2, 'Sun-dried tomatoes' => 0.25, 'Parmesan cheese' => 2, 'Olive oil' => 2, 'Fresh basil' => 1]);

        $this->createRecipe($diet, 'Bacon Cheeseburger Bowl', 'lunch',
            'Serve seasoned ground beef over lettuce with bacon, cheese, and pickles.', 20,
            ['Ground beef' => 6, 'Bacon' => 2, 'Cheddar cheese' => 0.25, 'Romaine lettuce' => 0.5, 'Tomatoes' => 0.5]);

        $this->createRecipe($diet, 'Shrimp Avocado Salad', 'lunch',
            'Toss grilled shrimp with avocado, cucumber, and lime dressing.', 15,
            ['Shrimp' => 6, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Lime' => 0.5, 'Olive oil' => 2, 'Fresh cilantro' => 1]);

        $this->createRecipe($diet, 'Caprese Stack', 'lunch',
            'Layer fresh mozzarella with tomatoes and basil. Drizzle with olive oil.', 5,
            ['Mozzarella cheese' => 0.5, 'Tomatoes' => 2, 'Fresh basil' => 1, 'Olive oil' => 2, 'Balsamic vinegar' => 1]);

        // Additional Dinners
        $this->createRecipe($diet, 'Butter Baked Chicken Thighs', 'dinner',
            'Roast chicken thighs in butter with garlic and herbs until crispy.', 40,
            ['Chicken breast' => 8, 'Butter' => 3, 'Garlic' => 3, 'Fresh rosemary' => 1, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Stuffed Pork Tenderloin', 'dinner',
            'Stuff pork with spinach and cream cheese. Roast until golden.', 45,
            ['Pork tenderloin' => 8, 'Spinach' => 2, 'Cream cheese' => 2, 'Garlic' => 2, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Garlic Butter Shrimp', 'dinner',
            'Sauté shrimp in garlic butter with lemon and parsley. Serve with zoodles.', 15,
            ['Shrimp' => 8, 'Butter' => 3, 'Garlic' => 4, 'Lemon' => 0.5, 'Fresh parsley' => 1, 'Zucchini' => 1]);

        $this->createRecipe($diet, 'Keto Meatballs', 'dinner',
            'Bake almond flour meatballs in marinara. Top with melted mozzarella.', 35,
            ['Ground beef' => 6, 'Almond flour' => 0.25, 'Eggs' => 1, 'Diced tomatoes (canned)' => 0.5, 'Mozzarella cheese' => 0.5, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Pan-Seared Duck Breast', 'dinner',
            'Score and pan-sear duck breast. Serve with sautéed greens.', 30,
            ['Chicken breast' => 6, 'Kale' => 0.5, 'Butter' => 2, 'Garlic' => 2, 'Fresh thyme' => 1, 'Sea salt' => 0.5]);

        $this->createRecipe($diet, 'Cheesy Broccoli Casserole', 'dinner',
            'Bake broccoli with cheddar cheese sauce, bacon, and sour cream.', 30,
            ['Broccoli' => 0.5, 'Cheddar cheese' => 0.5, 'Bacon' => 3, 'Sour cream' => 0.5, 'Heavy cream' => 0.25]);

        $this->createRecipe($diet, 'Lamb Chops with Herb Butter', 'dinner',
            'Grill lamb chops and top with compound herb butter.', 25,
            ['Ground beef' => 8, 'Butter' => 3, 'Fresh rosemary' => 1, 'Fresh mint' => 1, 'Garlic' => 2, 'Sea salt' => 0.5]);

        $this->createRecipe($diet, 'Bacon-Wrapped Chicken', 'dinner',
            'Wrap chicken breasts in bacon and bake until crispy. Serve with asparagus.', 35,
            ['Chicken breast' => 6, 'Bacon' => 4, 'Asparagus' => 0.5, 'Olive oil' => 1, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Zucchini Lasagna', 'dinner',
            'Layer zucchini slices with meat sauce and ricotta. Bake until bubbly.', 50,
            ['Zucchini' => 2, 'Ground beef' => 6, 'Ricotta cheese' => 0.5, 'Mozzarella cheese' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Creamy Garlic Chicken', 'dinner',
            'Pan-fry chicken in creamy garlic parmesan sauce. Serve with roasted broccoli.', 30,
            ['Chicken breast' => 6, 'Heavy cream' => 0.5, 'Parmesan cheese' => 2, 'Garlic' => 3, 'Broccoli' => 0.5, 'Butter' => 2]);
    }

    private function seedDash(): void
    {
        $diet = Diet::where('slug', 'dash')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Oatmeal with Berries and Walnuts', 'breakfast',
            'Cook oats with low-fat milk. Top with fresh berries and chopped walnuts.', 10,
            ['Oats' => 0.5, 'Milk' => 1, 'Blueberries' => 0.5, 'Walnuts' => 0.25, 'Cinnamon' => 0.5]);

        $this->createRecipe($diet, 'Veggie Egg White Omelet', 'breakfast',
            'Make fluffy egg white omelet filled with spinach, tomatoes, and mushrooms.', 15,
            ['Eggs' => 3, 'Spinach' => 2, 'Tomatoes' => 1, 'Mushrooms' => 4, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Whole Grain Toast with Banana', 'breakfast',
            'Toast whole grain bread, spread with almond butter, and top with sliced banana.', 10,
            ['Whole wheat bread' => 2, 'Almond butter' => 2, 'Banana' => 1]);

        $this->createRecipe($diet, 'Greek Yogurt with Fruit', 'breakfast',
            'Top low-fat Greek yogurt with mixed berries and a sprinkle of flax seeds.', 5,
            ['Greek yogurt' => 1, 'Strawberries' => 0.5, 'Blueberries' => 0.25, 'Flax seeds' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Turkey and Veggie Wrap', 'lunch',
            'Wrap sliced turkey breast with lettuce, tomato, cucumber in whole wheat tortilla.', 10,
            ['Ground turkey' => 4, 'Whole wheat bread' => 2, 'Romaine lettuce' => 0.25, 'Tomatoes' => 1, 'Cucumber' => 0.5, 'Dijon mustard' => 1]);

        $this->createRecipe($diet, 'Chicken and Vegetable Soup', 'lunch',
            'Simmer chicken breast with carrots, celery, onion in low-sodium broth. Add herbs.', 40,
            ['Chicken breast' => 4, 'Carrots' => 2, 'Celery' => 3, 'Onion' => 0.5, 'Chicken broth' => 3, 'Fresh thyme' => 1, 'Fresh parsley' => 1]);

        $this->createRecipe($diet, 'Quinoa and Black Bean Salad', 'lunch',
            'Toss quinoa with black beans, corn, bell pepper, and lime vinaigrette.', 20,
            ['Quinoa' => 1, 'Black beans' => 0.5, 'Bell pepper' => 1, 'Fresh cilantro' => 1, 'Lime' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Tuna Salad on Greens', 'lunch',
            'Mix tuna with Greek yogurt instead of mayo. Serve over mixed greens with vegetables.', 15,
            ['Tuna' => 5, 'Greek yogurt' => 0.25, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Lemon' => 0.5]);

        // Dinners
        $this->createRecipe($diet, 'Herb Baked Chicken with Sweet Potato', 'dinner',
            'Bake chicken breast with herbs. Serve with baked sweet potato and steamed broccoli.', 40,
            ['Chicken breast' => 6, 'Sweet potato' => 1, 'Broccoli' => 0.5, 'Olive oil' => 1, 'Fresh rosemary' => 1, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Grilled Fish with Vegetables', 'dinner',
            'Grill fish with lemon and herbs. Serve with roasted zucchini and bell peppers.', 25,
            ['Cod' => 6, 'Zucchini' => 1, 'Bell pepper' => 1, 'Lemon' => 0.5, 'Olive oil' => 1, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Turkey Meatballs with Pasta', 'dinner',
            'Bake turkey meatballs in marinara. Serve over whole wheat pasta with vegetables.', 40,
            ['Ground turkey' => 6, 'Whole wheat pasta' => 1, 'Diced tomatoes (canned)' => 1, 'Spinach' => 2, 'Garlic' => 2, 'Italian seasoning' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Salmon with Quinoa and Greens', 'dinner',
            'Bake salmon with lemon. Serve over quinoa with sautéed kale and garlic.', 30,
            ['Salmon fillet' => 6, 'Quinoa' => 1, 'Kale' => 0.5, 'Garlic' => 2, 'Lemon' => 0.5, 'Olive oil' => 1]);

        // Additional Breakfasts
        $this->createRecipe($diet, 'Banana Oat Pancakes', 'breakfast',
            'Blend oats with banana and eggs. Cook as pancakes and serve with fresh fruit.', 20,
            ['Oats' => 0.5, 'Banana' => 1, 'Eggs' => 2, 'Milk' => 0.25, 'Blueberries' => 0.5]);

        $this->createRecipe($diet, 'Spinach Egg Scramble', 'breakfast',
            'Scramble eggs with fresh spinach and a sprinkle of low-fat cheese.', 10,
            ['Eggs' => 2, 'Spinach' => 2, 'Mozzarella cheese' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Apple Cinnamon Oatmeal', 'breakfast',
            'Cook oats with diced apples and cinnamon. Top with a few walnuts.', 15,
            ['Oats' => 0.5, 'Milk' => 1, 'Cinnamon' => 0.5, 'Walnuts' => 0.25, 'Honey' => 1]);

        $this->createRecipe($diet, 'Cottage Cheese with Pineapple', 'breakfast',
            'Top low-fat cottage cheese with fresh pineapple and a sprinkle of flax seeds.', 5,
            ['Cottage cheese' => 1, 'Flax seeds' => 1, 'Honey' => 0.5]);

        $this->createRecipe($diet, 'Veggie Breakfast Burrito', 'breakfast',
            'Fill whole wheat tortilla with scrambled eggs, black beans, and salsa.', 15,
            ['Whole wheat bread' => 2, 'Eggs' => 2, 'Black beans' => 0.25, 'Tomatoes' => 0.5, 'Fresh cilantro' => 1]);

        $this->createRecipe($diet, 'Overnight Chia Pudding', 'breakfast',
            'Soak chia seeds in low-fat milk overnight. Top with fresh berries.', 5,
            ['Chia seeds' => 2, 'Milk' => 1, 'Strawberries' => 0.5, 'Honey' => 1]);

        $this->createRecipe($diet, 'Mushroom and Herb Omelet', 'breakfast',
            'Make a fluffy omelet filled with sautéed mushrooms and fresh herbs.', 15,
            ['Eggs' => 2, 'Mushrooms' => 4, 'Fresh parsley' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Mango Smoothie', 'breakfast',
            'Blend frozen mango with Greek yogurt and a splash of orange juice.', 5,
            ['Greek yogurt' => 1, 'Banana' => 0.5, 'Almond milk' => 0.5]);

        $this->createRecipe($diet, 'Avocado Toast with Egg', 'breakfast',
            'Top whole grain toast with mashed avocado and a poached egg.', 15,
            ['Whole wheat bread' => 2, 'Avocado' => 0.5, 'Eggs' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Steel Cut Oats with Nuts', 'breakfast',
            'Cook steel cut oats and top with mixed nuts and a drizzle of maple syrup.', 25,
            ['Oats' => 0.5, 'Milk' => 1, 'Walnuts' => 0.25, 'Almonds' => 0.25, 'Maple syrup' => 1]);

        // Additional Lunches
        $this->createRecipe($diet, 'Mediterranean Tuna Salad', 'lunch',
            'Mix tuna with olive oil, lemon, and herbs. Serve over mixed greens.', 15,
            ['Tuna' => 5, 'Mixed greens' => 3, 'Cherry tomatoes' => 0.5, 'Cucumber' => 0.5, 'Olive oil' => 1, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Turkey Avocado Sandwich', 'lunch',
            'Layer sliced turkey with avocado, lettuce, and tomato on whole grain bread.', 10,
            ['Ground turkey' => 4, 'Whole wheat bread' => 2, 'Avocado' => 0.5, 'Romaine lettuce' => 0.25, 'Tomatoes' => 1]);

        $this->createRecipe($diet, 'Lentil Vegetable Soup', 'lunch',
            'Simmer lentils with carrots, celery, and tomatoes in low-sodium broth.', 40,
            ['Lentils' => 1, 'Carrots' => 2, 'Celery' => 2, 'Diced tomatoes (canned)' => 1, 'Vegetable broth' => 2, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Grilled Chicken Wrap', 'lunch',
            'Wrap grilled chicken with hummus, spinach, and roasted peppers.', 20,
            ['Chicken breast' => 6, 'Whole wheat bread' => 2, 'Hummus' => 0.5, 'Spinach' => 2, 'Bell pepper' => 0.5]);

        $this->createRecipe($diet, 'Spinach and Strawberry Salad', 'lunch',
            'Toss spinach with strawberries, walnuts, and balsamic vinaigrette.', 10,
            ['Spinach' => 4, 'Strawberries' => 0.5, 'Walnuts' => 0.25, 'Goat cheese' => 0.25, 'Balsamic vinegar' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Brown Rice Bowl', 'lunch',
            'Top brown rice with black beans, grilled chicken, and fresh salsa.', 25,
            ['Brown rice' => 1, 'Black beans' => 0.5, 'Chicken breast' => 4, 'Tomatoes' => 0.5, 'Fresh cilantro' => 1, 'Lime' => 0.5]);

        $this->createRecipe($diet, 'White Bean Salad', 'lunch',
            'Toss white beans with tomatoes, cucumber, and fresh herbs in olive oil.', 15,
            ['White beans' => 1, 'Cherry tomatoes' => 0.5, 'Cucumber' => 0.5, 'Fresh parsley' => 1, 'Olive oil' => 1, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Vegetable Minestrone', 'lunch',
            'Simmer vegetables and white beans in tomato broth with whole wheat pasta.', 40,
            ['Diced tomatoes (canned)' => 1, 'White beans' => 0.5, 'Whole wheat pasta' => 0.5, 'Carrots' => 2, 'Celery' => 2, 'Vegetable broth' => 2]);

        $this->createRecipe($diet, 'Salmon Salad', 'lunch',
            'Flake baked salmon over mixed greens with cucumber and light dressing.', 20,
            ['Salmon fillet' => 4, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 1, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Hummus Veggie Plate', 'lunch',
            'Serve hummus with raw vegetables and whole wheat pita triangles.', 10,
            ['Hummus' => 0.5, 'Carrots' => 2, 'Cucumber' => 0.5, 'Bell pepper' => 1, 'Whole wheat bread' => 2]);

        // Additional Dinners
        $this->createRecipe($diet, 'Lemon Garlic Tilapia', 'dinner',
            'Bake tilapia with lemon, garlic, and herbs. Serve with steamed vegetables.', 25,
            ['Cod' => 6, 'Lemon' => 0.5, 'Garlic' => 2, 'Fresh dill' => 1, 'Asparagus' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Chicken and Vegetable Stir-Fry', 'dinner',
            'Stir-fry chicken with colorful vegetables in low-sodium soy sauce.', 25,
            ['Chicken breast' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Carrots' => 1, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Brown rice' => 1]);

        $this->createRecipe($diet, 'Baked Cod with Vegetables', 'dinner',
            'Bake cod with zucchini, tomatoes, and fresh herbs.', 25,
            ['Cod' => 6, 'Zucchini' => 1, 'Cherry tomatoes' => 0.5, 'Fresh basil' => 1, 'Olive oil' => 1, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Turkey Vegetable Soup', 'dinner',
            'Simmer lean ground turkey with vegetables in low-sodium broth.', 35,
            ['Ground turkey' => 6, 'Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Chicken broth' => 2, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Grilled Chicken with Sweet Potato', 'dinner',
            'Grill seasoned chicken breast. Serve with baked sweet potato and greens.', 35,
            ['Chicken breast' => 6, 'Sweet potato' => 1, 'Mixed greens' => 2, 'Olive oil' => 1, 'Fresh rosemary' => 1]);

        $this->createRecipe($diet, 'Shrimp and Vegetable Skillet', 'dinner',
            'Sauté shrimp with zucchini, tomatoes, and garlic. Serve over quinoa.', 20,
            ['Shrimp' => 6, 'Zucchini' => 1, 'Cherry tomatoes' => 0.5, 'Garlic' => 2, 'Quinoa' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Lean Beef Stir-Fry', 'dinner',
            'Stir-fry lean beef with broccoli and bell peppers in ginger sauce.', 25,
            ['Ground beef' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Brown rice' => 1]);

        $this->createRecipe($diet, 'Baked Chicken Parmesan', 'dinner',
            'Bake breaded chicken with marinara and a light sprinkle of cheese.', 35,
            ['Chicken breast' => 6, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.25, 'Parmesan cheese' => 1, 'Whole wheat pasta' => 1, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Pork Tenderloin with Apples', 'dinner',
            'Roast pork tenderloin with apples and rosemary. Serve with roasted vegetables.', 40,
            ['Pork tenderloin' => 6, 'Onion' => 0.5, 'Fresh rosemary' => 1, 'Olive oil' => 1, 'Sweet potato' => 1]);

        $this->createRecipe($diet, 'Mediterranean Chicken', 'dinner',
            'Bake chicken with olives, tomatoes, and artichokes. Serve with whole grain couscous.', 35,
            ['Chicken breast' => 6, 'Olives' => 0.25, 'Cherry tomatoes' => 0.5, 'Garlic' => 2, 'Farro' => 1, 'Olive oil' => 1]);
    }

    private function seedGlutenFree(): void
    {
        $diet = Diet::where('slug', 'gluten-free')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Gluten-Free Oatmeal Bowl', 'breakfast',
            'Cook certified gluten-free oats with almond milk. Top with berries and nuts.', 10,
            ['Gluten-free oats' => 0.5, 'Almond milk' => 1, 'Blueberries' => 0.5, 'Almonds' => 0.25, 'Honey' => 1]);

        $this->createRecipe($diet, 'Sweet Potato Hash with Eggs', 'breakfast',
            'Sauté diced sweet potato with onions and peppers. Top with fried eggs.', 25,
            ['Sweet potato' => 1, 'Onion' => 0.5, 'Bell pepper' => 1, 'Eggs' => 2, 'Olive oil' => 1, 'Paprika' => 0.5]);

        $this->createRecipe($diet, 'Chia Pudding', 'breakfast',
            'Mix chia seeds with coconut milk overnight. Top with fresh fruit and coconut.', 5,
            ['Chia seeds' => 3, 'Coconut milk' => 1, 'Strawberries' => 0.5, 'Honey' => 1]);

        $this->createRecipe($diet, 'Banana Almond Smoothie', 'breakfast',
            'Blend banana, almond butter, almond milk, and a handful of spinach.', 5,
            ['Banana' => 1, 'Almond butter' => 2, 'Almond milk' => 1, 'Spinach' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Rice Paper Spring Rolls', 'lunch',
            'Fill rice paper with shrimp, rice noodles, vegetables, and fresh herbs. Serve with peanut sauce.', 30,
            ['Shrimp' => 4, 'Rice noodles' => 0.5, 'Carrots' => 2, 'Cucumber' => 0.5, 'Fresh cilantro' => 1, 'Fresh mint' => 1]);

        $this->createRecipe($diet, 'Grilled Chicken Salad', 'lunch',
            'Top mixed greens with grilled chicken, avocado, tomatoes, and balsamic dressing.', 20,
            ['Mixed greens' => 3, 'Chicken breast' => 6, 'Avocado' => 0.5, 'Cherry tomatoes' => 0.5, 'Balsamic vinegar' => 1, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Stuffed Sweet Potato', 'lunch',
            'Bake sweet potato and stuff with black beans, salsa, avocado, and Greek yogurt.', 45,
            ['Sweet potato' => 1, 'Black beans' => 0.5, 'Avocado' => 0.5, 'Greek yogurt' => 0.25, 'Fresh cilantro' => 1, 'Lime' => 0.5]);

        $this->createRecipe($diet, 'Quinoa Tabbouleh', 'lunch',
            'Mix quinoa with cucumber, tomatoes, fresh parsley, mint, lemon, and olive oil.', 20,
            ['Quinoa' => 1, 'Cucumber' => 0.5, 'Tomatoes' => 1, 'Fresh parsley' => 2, 'Fresh mint' => 1, 'Lemon' => 1, 'Olive oil' => 2]);

        // Dinners
        $this->createRecipe($diet, 'Lemon Herb Salmon with Rice', 'dinner',
            'Bake salmon with lemon and herbs. Serve with brown rice and steamed vegetables.', 30,
            ['Salmon fillet' => 6, 'Brown rice' => 1, 'Asparagus' => 0.5, 'Lemon' => 0.5, 'Fresh dill' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Chicken Stir-Fry with Rice Noodles', 'dinner',
            'Stir-fry chicken with vegetables in coconut aminos. Serve over rice noodles.', 25,
            ['Chicken breast' => 6, 'Rice noodles' => 1, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 2, 'Garlic' => 2, 'Ginger' => 0.5]);

        $this->createRecipe($diet, 'Shrimp and Vegetable Skewers', 'dinner',
            'Grill shrimp and vegetable skewers with olive oil and herbs. Serve with quinoa.', 25,
            ['Shrimp' => 6, 'Zucchini' => 1, 'Bell pepper' => 1, 'Cherry tomatoes' => 0.5, 'Quinoa' => 1, 'Olive oil' => 2, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Beef and Broccoli', 'dinner',
            'Stir-fry sliced beef with broccoli in gluten-free soy sauce. Serve over rice.', 25,
            ['Ground beef' => 6, 'Broccoli' => 0.5, 'Coconut aminos' => 2, 'Brown rice' => 1, 'Garlic' => 2, 'Ginger' => 0.5]);

        // Additional Breakfasts
        $this->createRecipe($diet, 'Coconut Flour Pancakes', 'breakfast',
            'Make fluffy pancakes with coconut flour, eggs, and vanilla. Serve with maple syrup.', 20,
            ['Eggs' => 3, 'Coconut milk' => 0.5, 'Banana' => 0.5, 'Maple syrup' => 1]);

        $this->createRecipe($diet, 'Smoked Salmon and Eggs', 'breakfast',
            'Serve scrambled eggs alongside smoked salmon, capers, and fresh dill.', 15,
            ['Salmon fillet' => 4, 'Eggs' => 2, 'Capers' => 1, 'Fresh dill' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Tropical Fruit Bowl', 'breakfast',
            'Combine fresh mango, pineapple, and coconut. Top with toasted coconut flakes.', 10,
            ['Banana' => 0.5, 'Coconut milk' => 0.25, 'Honey' => 1]);

        $this->createRecipe($diet, 'Hash Brown Egg Nests', 'breakfast',
            'Bake shredded potato nests and crack eggs into the center.', 30,
            ['Sweet potato' => 1, 'Eggs' => 2, 'Olive oil' => 1, 'Sea salt' => 0.25, 'Fresh parsley' => 1]);

        $this->createRecipe($diet, 'Almond Butter Banana Bites', 'breakfast',
            'Top banana slices with almond butter and a sprinkle of cinnamon.', 5,
            ['Banana' => 1, 'Almond butter' => 2, 'Cinnamon' => 0.5, 'Honey' => 0.5]);

        $this->createRecipe($diet, 'Veggie and Cheese Frittata', 'breakfast',
            'Bake eggs with zucchini, peppers, and cheese until golden.', 25,
            ['Eggs' => 3, 'Zucchini' => 0.5, 'Bell pepper' => 0.5, 'Cheddar cheese' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Rice Cake with Avocado', 'breakfast',
            'Top rice cakes with mashed avocado, everything seasoning, and a fried egg.', 10,
            ['Avocado' => 0.5, 'Eggs' => 1, 'Sea salt' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Coconut Yogurt Parfait', 'breakfast',
            'Layer coconut yogurt with fresh berries and gluten-free granola.', 10,
            ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Strawberries' => 0.5, 'Honey' => 1]);

        $this->createRecipe($diet, 'Breakfast Sausage Patties', 'breakfast',
            'Make homemade sausage patties with ground pork and herbs. Serve with eggs.', 20,
            ['Pork tenderloin' => 4, 'Eggs' => 2, 'Fresh thyme' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Mango Chia Pudding', 'breakfast',
            'Blend mango into chia pudding base. Top with fresh mango cubes.', 5,
            ['Chia seeds' => 2, 'Coconut milk' => 1, 'Honey' => 1]);

        // Additional Lunches
        $this->createRecipe($diet, 'Thai Chicken Lettuce Cups', 'lunch',
            'Fill lettuce cups with seasoned ground chicken, herbs, and peanut sauce.', 20,
            ['Chicken breast' => 6, 'Romaine lettuce' => 0.5, 'Fresh cilantro' => 1, 'Fresh mint' => 1, 'Coconut aminos' => 1, 'Lime' => 0.5]);

        $this->createRecipe($diet, 'Salmon Avocado Bowl', 'lunch',
            'Top rice with grilled salmon, avocado, cucumber, and sesame seeds.', 25,
            ['Salmon fillet' => 6, 'Brown rice' => 1, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Sesame seeds' => 1, 'Coconut aminos' => 1]);

        $this->createRecipe($diet, 'Chicken Vegetable Soup', 'lunch',
            'Simmer chicken with carrots, celery, and herbs in gluten-free broth.', 40,
            ['Chicken breast' => 4, 'Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Chicken broth' => 2, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Taco Salad Bowl', 'lunch',
            'Top lettuce with seasoned beef, tomatoes, cheese, and gluten-free salsa.', 20,
            ['Ground beef' => 6, 'Romaine lettuce' => 0.5, 'Tomatoes' => 1, 'Cheddar cheese' => 0.25, 'Sour cream' => 2, 'Fresh cilantro' => 1]);

        $this->createRecipe($diet, 'Shrimp and Mango Salad', 'lunch',
            'Toss grilled shrimp with mixed greens, mango, and lime dressing.', 20,
            ['Shrimp' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Lime' => 0.5, 'Fresh cilantro' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Cauliflower Fried Rice', 'lunch',
            'Stir-fry cauliflower rice with vegetables, eggs, and coconut aminos.', 20,
            ['Cauliflower' => 0.5, 'Eggs' => 2, 'Carrots' => 1, 'Coconut aminos' => 1, 'Ginger' => 0.5, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Greek Chicken Bowl', 'lunch',
            'Top rice with grilled chicken, cucumber, tomatoes, and tzatziki.', 25,
            ['Chicken breast' => 6, 'Brown rice' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Greek yogurt' => 0.25, 'Fresh dill' => 1]);

        $this->createRecipe($diet, 'Turkey Lettuce Wraps', 'lunch',
            'Fill lettuce cups with seasoned ground turkey and fresh vegetables.', 20,
            ['Ground turkey' => 6, 'Romaine lettuce' => 0.5, 'Carrots' => 1, 'Coconut aminos' => 1, 'Fresh cilantro' => 1, 'Lime' => 0.5]);

        $this->createRecipe($diet, 'Zucchini Noodle Primavera', 'lunch',
            'Toss zucchini noodles with sautéed vegetables and olive oil.', 20,
            ['Zucchini' => 2, 'Bell pepper' => 1, 'Cherry tomatoes' => 0.5, 'Garlic' => 2, 'Olive oil' => 2, 'Fresh basil' => 1]);

        $this->createRecipe($diet, 'Chicken and Rice Soup', 'lunch',
            'Make comforting soup with chicken, rice, and vegetables.', 40,
            ['Chicken breast' => 4, 'Brown rice' => 0.5, 'Carrots' => 2, 'Celery' => 2, 'Chicken broth' => 2, 'Fresh parsley' => 1]);

        // Additional Dinners
        $this->createRecipe($diet, 'Herb Roasted Chicken', 'dinner',
            'Roast chicken with fresh herbs and garlic. Serve with roasted vegetables.', 50,
            ['Chicken breast' => 8, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Garlic' => 4, 'Carrots' => 2, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Grilled Steak with Chimichurri', 'dinner',
            'Grill steak and top with fresh herb chimichurri sauce. Serve with sweet potato.', 30,
            ['Ground beef' => 8, 'Fresh parsley' => 2, 'Fresh cilantro' => 1, 'Garlic' => 3, 'Olive oil' => 2, 'Sweet potato' => 1]);

        $this->createRecipe($diet, 'Coconut Curry Shrimp', 'dinner',
            'Simmer shrimp in coconut curry sauce with vegetables. Serve over rice.', 25,
            ['Shrimp' => 8, 'Coconut milk' => 1, 'Bell pepper' => 1, 'Turmeric' => 0.5, 'Ginger' => 0.5, 'Brown rice' => 1]);

        $this->createRecipe($diet, 'Stuffed Acorn Squash', 'dinner',
            'Fill roasted squash halves with quinoa, cranberries, and pecans.', 45,
            ['Quinoa' => 1, 'Walnuts' => 0.25, 'Fresh thyme' => 1, 'Olive oil' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Teriyaki Salmon', 'dinner',
            'Glaze salmon with gluten-free teriyaki. Serve with steamed broccoli and rice.', 25,
            ['Salmon fillet' => 6, 'Coconut aminos' => 2, 'Honey' => 1, 'Ginger' => 0.5, 'Broccoli' => 0.5, 'Brown rice' => 1]);

        $this->createRecipe($diet, 'Mediterranean Lamb Chops', 'dinner',
            'Grill lamb chops with herbs and serve with roasted vegetables.', 30,
            ['Ground beef' => 8, 'Fresh rosemary' => 1, 'Garlic' => 3, 'Zucchini' => 1, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Pork Stir-Fry', 'dinner',
            'Stir-fry sliced pork with vegetables in gluten-free sauce.', 25,
            ['Pork tenderloin' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 1, 'Ginger' => 0.5, 'Brown rice' => 1]);

        $this->createRecipe($diet, 'Balsamic Glazed Chicken', 'dinner',
            'Pan-sear chicken and glaze with balsamic reduction. Serve with quinoa.', 30,
            ['Chicken breast' => 6, 'Balsamic vinegar' => 2, 'Honey' => 1, 'Quinoa' => 1, 'Asparagus' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Fish Tacos', 'dinner',
            'Grill fish and serve in corn tortillas with cabbage slaw and lime crema.', 25,
            ['Cod' => 6, 'Lime' => 0.5, 'Sour cream' => 2, 'Fresh cilantro' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Turkey and Sweet Potato Skillet', 'dinner',
            'Sauté ground turkey with sweet potatoes, kale, and spices.', 25,
            ['Ground turkey' => 6, 'Sweet potato' => 1, 'Kale' => 0.5, 'Garlic' => 2, 'Cumin' => 0.5, 'Olive oil' => 1]);
    }

    private function seedLectinFree(): void
    {
        $diet = Diet::where('slug', 'lectin-free')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Pasture-Raised Eggs with Greens', 'breakfast',
            'Scramble eggs and serve over sautéed kale and spinach with avocado.', 15,
            ['Eggs' => 3, 'Kale' => 0.5, 'Spinach' => 2, 'Avocado' => 0.5, 'Olive oil' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Coconut Yogurt with Berries', 'breakfast',
            'Top coconut yogurt with in-season berries and a sprinkle of walnuts.', 5,
            ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Walnuts' => 0.25]);

        $this->createRecipe($diet, 'Smoked Salmon Plate', 'breakfast',
            'Serve wild-caught smoked salmon with avocado, capers, and fresh dill.', 10,
            ['Salmon fillet' => 4, 'Avocado' => 0.5, 'Capers' => 1, 'Fresh dill' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Sweet Potato and Sausage Skillet', 'breakfast',
            'Cook diced sweet potato with pasture-raised sausage and onions.', 25,
            ['Sweet potato' => 1, 'Pork tenderloin' => 4, 'Onion' => 0.5, 'Olive oil' => 1, 'Fresh rosemary' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Wild Salmon Salad', 'lunch',
            'Top mixed greens with wild salmon, avocado, and olive oil dressing.', 15,
            ['Salmon fillet' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Chicken Caesar (Lectin-Free)', 'lunch',
            'Romaine with grilled chicken, olive oil, lemon, and parmesan (no croutons).', 20,
            ['Romaine lettuce' => 0.5, 'Chicken breast' => 6, 'Parmesan cheese' => 2, 'Olive oil' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Cauliflower Rice Bowl', 'lunch',
            'Serve seasoned cauliflower rice with grilled chicken, avocado, and greens.', 20,
            ['Cauliflower' => 0.5, 'Chicken breast' => 6, 'Avocado' => 0.5, 'Mixed greens' => 2, 'Olive oil' => 1, 'Lime' => 0.5]);

        $this->createRecipe($diet, 'Shrimp and Avocado Salad', 'lunch',
            'Toss grilled shrimp with avocado, cucumber, and citrus dressing.', 20,
            ['Shrimp' => 6, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Lime' => 0.5, 'Olive oil' => 2, 'Fresh cilantro' => 1]);

        // Dinners
        $this->createRecipe($diet, 'Grass-Fed Steak with Asparagus', 'dinner',
            'Pan-sear grass-fed steak. Roast asparagus with olive oil and garlic.', 25,
            ['Ground beef' => 8, 'Asparagus' => 1, 'Olive oil' => 2, 'Garlic' => 2, 'Fresh rosemary' => 1, 'Butter' => 2]);

        $this->createRecipe($diet, 'Baked Cod with Roasted Vegetables', 'dinner',
            'Bake wild-caught cod with olive oil and herbs. Serve with roasted broccoli and cauliflower.', 30,
            ['Cod' => 6, 'Broccoli' => 0.5, 'Cauliflower' => 0.25, 'Olive oil' => 2, 'Lemon' => 0.5, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Roasted Chicken with Sweet Potato', 'dinner',
            'Roast chicken thighs with herbs. Serve with mashed sweet potato and sautéed greens.', 45,
            ['Chicken breast' => 8, 'Sweet potato' => 1, 'Kale' => 0.5, 'Olive oil' => 2, 'Fresh rosemary' => 1, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Lamb Chops with Mint', 'dinner',
            'Grill lamb chops with olive oil and mint. Serve with roasted cauliflower.', 25,
            ['Pork tenderloin' => 6, 'Cauliflower' => 0.5, 'Fresh mint' => 2, 'Olive oil' => 2, 'Garlic' => 2, 'Sea salt' => 0.5]);

        // Additional Breakfasts
        $this->createRecipe($diet, 'Avocado and Egg Bowl', 'breakfast',
            'Top mashed avocado with poached eggs and a sprinkle of sea salt.', 15,
            ['Avocado' => 1, 'Eggs' => 2, 'Sea salt' => 0.25, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Bacon and Spinach Scramble', 'breakfast',
            'Scramble eggs with crispy bacon and sautéed spinach.', 15,
            ['Eggs' => 3, 'Bacon' => 3, 'Spinach' => 2, 'Butter' => 1]);

        $this->createRecipe($diet, 'Coconut Chia Bowl', 'breakfast',
            'Mix chia seeds with coconut milk overnight. Top with berries.', 5,
            ['Chia seeds' => 2, 'Coconut milk' => 1, 'Blueberries' => 0.5, 'Honey' => 1]);

        $this->createRecipe($diet, 'Green Smoothie', 'breakfast',
            'Blend spinach, avocado, and coconut milk for a creamy green smoothie.', 5,
            ['Spinach' => 2, 'Avocado' => 0.5, 'Coconut milk' => 1, 'Honey' => 1]);

        $this->createRecipe($diet, 'Sweet Potato Breakfast Hash', 'breakfast',
            'Sauté diced sweet potato with onions. Top with fried eggs.', 25,
            ['Sweet potato' => 1, 'Onion' => 0.5, 'Eggs' => 2, 'Olive oil' => 1, 'Fresh rosemary' => 1]);

        $this->createRecipe($diet, 'Mushroom and Herb Eggs', 'breakfast',
            'Scramble eggs with sautéed mushrooms and fresh herbs.', 15,
            ['Eggs' => 3, 'Mushrooms' => 4, 'Fresh thyme' => 1, 'Butter' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Prosciutto Wrapped Melon', 'breakfast',
            'Wrap melon slices in prosciutto. Serve with a side of greens.', 10,
            ['Bacon' => 3, 'Mixed greens' => 2, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Collagen Smoothie', 'breakfast',
            'Blend coconut milk with berries and a handful of spinach.', 5,
            ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Spinach' => 1, 'Honey' => 1]);

        $this->createRecipe($diet, 'Sautéed Greens with Eggs', 'breakfast',
            'Sauté kale and spinach in olive oil. Top with fried eggs.', 15,
            ['Kale' => 0.5, 'Spinach' => 2, 'Eggs' => 2, 'Olive oil' => 1, 'Garlic' => 1]);

        $this->createRecipe($diet, 'Coconut Pancakes', 'breakfast',
            'Make grain-free pancakes with coconut flour and eggs.', 20,
            ['Eggs' => 3, 'Coconut milk' => 0.5, 'Honey' => 1, 'Butter' => 1]);

        // Additional Lunches
        $this->createRecipe($diet, 'Grilled Chicken Salad', 'lunch',
            'Top mixed greens with grilled chicken, avocado, and olive oil dressing.', 20,
            ['Chicken breast' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Smoked Salmon Salad', 'lunch',
            'Arrange smoked salmon over greens with capers and olive oil.', 10,
            ['Salmon fillet' => 6, 'Mixed greens' => 3, 'Capers' => 1, 'Fresh dill' => 1, 'Olive oil' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Shrimp Ceviche', 'lunch',
            'Marinate shrimp in citrus juice with avocado and herbs.', 25,
            ['Shrimp' => 6, 'Avocado' => 0.5, 'Lime' => 1, 'Lemon' => 0.5, 'Fresh cilantro' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Roasted Vegetable Plate', 'lunch',
            'Roast cauliflower, broccoli, and carrots. Drizzle with olive oil.', 35,
            ['Cauliflower' => 0.25, 'Broccoli' => 0.25, 'Carrots' => 2, 'Olive oil' => 2, 'Fresh rosemary' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Tuna and Avocado Boats', 'lunch',
            'Fill avocado halves with seasoned tuna salad.', 15,
            ['Tuna' => 5, 'Avocado' => 1, 'Olive oil' => 1, 'Lemon' => 0.5, 'Fresh parsley' => 1]);

        $this->createRecipe($diet, 'Herb Chicken Lettuce Wraps', 'lunch',
            'Fill lettuce cups with herb-seasoned shredded chicken.', 20,
            ['Chicken breast' => 6, 'Romaine lettuce' => 0.5, 'Fresh basil' => 1, 'Fresh mint' => 1, 'Olive oil' => 1, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Mashed Cauliflower Bowl', 'lunch',
            'Top creamy mashed cauliflower with grilled chicken and herbs.', 25,
            ['Cauliflower' => 0.5, 'Chicken breast' => 4, 'Butter' => 2, 'Garlic' => 2, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Steak Salad', 'lunch',
            'Top mixed greens with sliced grilled steak and olive oil dressing.', 25,
            ['Ground beef' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Olive oil' => 2, 'Balsamic vinegar' => 1]);

        $this->createRecipe($diet, 'Coconut Chicken Soup', 'lunch',
            'Simmer chicken in coconut milk with ginger and greens.', 35,
            ['Chicken breast' => 4, 'Coconut milk' => 1, 'Ginger' => 0.5, 'Kale' => 0.5, 'Garlic' => 2, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Crab and Avocado Salad', 'lunch',
            'Toss crab meat with avocado, lime, and fresh herbs over greens.', 15,
            ['Shrimp' => 6, 'Avocado' => 0.5, 'Mixed greens' => 2, 'Lime' => 0.5, 'Fresh cilantro' => 1, 'Olive oil' => 1]);

        // Additional Dinners
        $this->createRecipe($diet, 'Pan-Seared Scallops', 'dinner',
            'Sear scallops in butter until golden. Serve with sautéed greens.', 20,
            ['Shrimp' => 8, 'Butter' => 3, 'Kale' => 0.5, 'Garlic' => 2, 'Lemon' => 0.5]);

        $this->createRecipe($diet, 'Herb-Crusted Rack of Lamb', 'dinner',
            'Roast lamb with fresh herbs and garlic. Serve with roasted vegetables.', 45,
            ['Ground beef' => 8, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Garlic' => 3, 'Olive oil' => 2, 'Asparagus' => 0.5]);

        $this->createRecipe($diet, 'Salmon with Asparagus', 'dinner',
            'Bake salmon and asparagus on the same sheet pan with olive oil and herbs.', 25,
            ['Salmon fillet' => 6, 'Asparagus' => 1, 'Olive oil' => 2, 'Lemon' => 0.5, 'Fresh dill' => 1, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Grilled Chicken with Pesto', 'dinner',
            'Grill chicken and top with fresh basil pesto. Serve with roasted vegetables.', 30,
            ['Chicken breast' => 6, 'Fresh basil' => 2, 'Olive oil' => 3, 'Garlic' => 2, 'Broccoli' => 0.5]);

        $this->createRecipe($diet, 'Pork Tenderloin with Herbs', 'dinner',
            'Roast pork tenderloin with rosemary and thyme. Serve with cauliflower mash.', 40,
            ['Pork tenderloin' => 8, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Cauliflower' => 0.5, 'Butter' => 2, 'Garlic' => 2]);

        $this->createRecipe($diet, 'Duck Breast with Greens', 'dinner',
            'Pan-sear duck breast and serve over sautéed kale and spinach.', 30,
            ['Chicken breast' => 6, 'Kale' => 0.5, 'Spinach' => 2, 'Olive oil' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Shrimp and Zucchini Noodles', 'dinner',
            'Sauté shrimp with garlic and toss with zucchini noodles.', 20,
            ['Shrimp' => 8, 'Zucchini' => 2, 'Garlic' => 3, 'Olive oil' => 2, 'Lemon' => 0.5, 'Fresh parsley' => 1]);

        $this->createRecipe($diet, 'Braised Short Ribs', 'dinner',
            'Braise beef short ribs with herbs until tender. Serve with mashed cauliflower.', 180,
            ['Ground beef' => 8, 'Chicken broth' => 1, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Cauliflower' => 0.5, 'Onion' => 0.5]);

        $this->createRecipe($diet, 'Baked Halibut with Lemon', 'dinner',
            'Bake halibut with lemon, capers, and fresh herbs.', 25,
            ['Cod' => 6, 'Lemon' => 1, 'Capers' => 1, 'Fresh dill' => 1, 'Olive oil' => 2, 'Asparagus' => 0.5]);

        $this->createRecipe($diet, 'Grilled Ribeye with Butter', 'dinner',
            'Grill ribeye steak and top with herb compound butter.', 25,
            ['Ground beef' => 8, 'Butter' => 3, 'Fresh rosemary' => 1, 'Garlic' => 2, 'Sea salt' => 0.5, 'Broccoli' => 0.5]);
    }

    private function seedKosher(): void
    {
        $diet = Diet::where('slug', 'kosher')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Challah French Toast', 'breakfast', 'Dip challah bread in egg mixture and pan-fry until golden. Serve with maple syrup.', 20, ['Eggs' => 2, 'Whole wheat bread' => 2, 'Maple syrup' => 1, 'Cinnamon' => 0.5, 'Milk' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Shakshuka', 'breakfast', 'Poach eggs in spiced tomato sauce with peppers and onions.', 25, ['Eggs' => 2, 'Diced tomatoes (canned)' => 1, 'Bell pepper' => 0.5, 'Onion' => 0.5, 'Cumin' => 0.5, 'Paprika' => 0.5]);
        $this->createRecipe($diet, 'Lox and Bagel Plate', 'breakfast', 'Serve smoked salmon with cream cheese, capers, and onion on a bagel.', 10, ['Salmon fillet' => 4, 'Cream cheese' => 2, 'Capers' => 1, 'Red onion' => 0.25, 'Whole wheat bread' => 2]);
        $this->createRecipe($diet, 'Israeli Breakfast Salad', 'breakfast', 'Dice cucumbers, tomatoes, and peppers. Serve with eggs and hummus.', 15, ['Cucumber' => 1, 'Tomatoes' => 1, 'Bell pepper' => 0.5, 'Eggs' => 2, 'Hummus' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Matzo Brei', 'breakfast', 'Scramble eggs with softened matzo and season with salt and pepper.', 15, ['Eggs' => 3, 'Butter' => 1, 'Sea salt' => 0.25]);
        $this->createRecipe($diet, 'Greek Yogurt with Honey', 'breakfast', 'Top Greek yogurt with honey, walnuts, and fresh berries.', 5, ['Greek yogurt' => 1, 'Honey' => 1, 'Walnuts' => 0.25, 'Blueberries' => 0.5]);
        $this->createRecipe($diet, 'Mushroom and Onion Omelet', 'breakfast', 'Make fluffy omelet filled with sautéed mushrooms and caramelized onions.', 20, ['Eggs' => 3, 'Mushrooms' => 4, 'Onion' => 0.5, 'Butter' => 1, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Avocado Toast with Za\'atar', 'breakfast', 'Top toast with mashed avocado, olive oil, and Middle Eastern spices.', 10, ['Whole wheat bread' => 2, 'Avocado' => 0.5, 'Olive oil' => 1, 'Sesame seeds' => 0.5]);
        $this->createRecipe($diet, 'Cottage Cheese Bowl', 'breakfast', 'Top cottage cheese with fresh vegetables and olive oil.', 5, ['Cottage cheese' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Oatmeal with Dates', 'breakfast', 'Cook oats and top with chopped dates and almonds.', 10, ['Oats' => 0.5, 'Milk' => 1, 'Almonds' => 0.25, 'Honey' => 1]);
        $this->createRecipe($diet, 'Feta and Vegetable Scramble', 'breakfast', 'Scramble eggs with feta cheese, tomatoes, and herbs.', 15, ['Eggs' => 3, 'Feta cheese' => 0.25, 'Cherry tomatoes' => 0.5, 'Fresh basil' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Banana Walnut Pancakes', 'breakfast', 'Make pancakes with mashed banana and walnuts. Serve with maple syrup.', 20, ['Eggs' => 2, 'Banana' => 1, 'Walnuts' => 0.25, 'Maple syrup' => 1, 'Milk' => 0.5]);
        $this->createRecipe($diet, 'Smoked Fish Platter', 'breakfast', 'Arrange smoked whitefish with crackers, tomatoes, and onion.', 10, ['Salmon fillet' => 4, 'Tomatoes' => 1, 'Red onion' => 0.25, 'Capers' => 1]);
        $this->createRecipe($diet, 'Burekas with Cheese', 'breakfast', 'Bake phyllo pastries filled with cheese and herbs.', 30, ['Feta cheese' => 0.5, 'Eggs' => 1, 'Sesame seeds' => 0.5]);

        // Lunches (14)
        $this->createRecipe($diet, 'Falafel Salad', 'lunch', 'Serve baked falafel over mixed greens with tahini dressing.', 30, ['Chickpeas' => 1, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Tahini' => 2, 'Lemon' => 0.5, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Kosher Deli Sandwich', 'lunch', 'Stack sliced beef brisket on rye with mustard.', 15, ['Ground beef' => 6, 'Whole wheat bread' => 2, 'Dijon mustard' => 1]);
        $this->createRecipe($diet, 'Hummus and Vegetable Plate', 'lunch', 'Serve hummus with fresh vegetables and whole wheat pita.', 10, ['Hummus' => 0.5, 'Cucumber' => 0.5, 'Carrots' => 2, 'Bell pepper' => 1, 'Whole wheat bread' => 2]);
        $this->createRecipe($diet, 'Israeli Couscous Salad', 'lunch', 'Toss couscous with cucumber, tomatoes, herbs, and lemon dressing.', 20, ['Farro' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Fresh parsley' => 1, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Grilled Salmon Salad', 'lunch', 'Top mixed greens with grilled salmon and olive oil dressing.', 25, ['Salmon fillet' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Soup', 'lunch', 'Simmer vegetables in vegetable broth with fresh herbs.', 40, ['Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Vegetable broth' => 2, 'Fresh thyme' => 1, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Tuna Nicoise Salad', 'lunch', 'Arrange tuna over greens with eggs, olives, and vegetables.', 20, ['Tuna' => 5, 'Mixed greens' => 3, 'Eggs' => 2, 'Olives' => 0.25, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Quinoa Tabbouleh', 'lunch', 'Mix quinoa with fresh herbs, tomatoes, and lemon juice.', 20, ['Quinoa' => 1, 'Fresh parsley' => 2, 'Fresh mint' => 1, 'Tomatoes' => 1, 'Lemon' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Stuffed Grape Leaves', 'lunch', 'Serve grape leaves stuffed with rice and herbs.', 15, ['Brown rice' => 1, 'Fresh parsley' => 1, 'Fresh mint' => 1, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Mediterranean Wrap', 'lunch', 'Fill whole wheat wrap with falafel, hummus, and vegetables.', 15, ['Whole wheat bread' => 2, 'Chickpeas' => 0.5, 'Hummus' => 0.5, 'Mixed greens' => 2, 'Cucumber' => 0.5]);
        $this->createRecipe($diet, 'Lentil Soup', 'lunch', 'Simmer lentils with vegetables and Middle Eastern spices.', 40, ['Lentils' => 1, 'Carrots' => 2, 'Onion' => 0.5, 'Cumin' => 0.5, 'Vegetable broth' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Egg Salad on Greens', 'lunch', 'Serve creamy egg salad over mixed greens.', 15, ['Eggs' => 4, 'Mixed greens' => 3, 'Dijon mustard' => 0.5, 'Fresh dill' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'White Bean Salad', 'lunch', 'Toss white beans with herbs, olive oil, and lemon.', 15, ['White beans' => 1, 'Fresh parsley' => 1, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Roasted Vegetable Plate', 'lunch', 'Roast seasonal vegetables with olive oil and herbs.', 35, ['Zucchini' => 1, 'Bell pepper' => 1, 'Eggplant' => 0.5, 'Olive oil' => 2, 'Fresh rosemary' => 1]);

        // Dinners (14)
        $this->createRecipe($diet, 'Herb Roasted Chicken', 'dinner', 'Roast chicken with fresh herbs and garlic.', 60, ['Chicken breast' => 8, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Garlic' => 4, 'Olive oil' => 2, 'Lemon' => 1]);
        $this->createRecipe($diet, 'Brisket with Root Vegetables', 'dinner', 'Braise brisket with carrots, onions, and potatoes.', 180, ['Ground beef' => 8, 'Carrots' => 3, 'Onion' => 1, 'Sweet potato' => 1, 'Chicken broth' => 2]);
        $this->createRecipe($diet, 'Grilled Salmon with Herbs', 'dinner', 'Grill salmon with dill and lemon. Serve with quinoa.', 25, ['Salmon fillet' => 6, 'Fresh dill' => 1, 'Lemon' => 0.5, 'Quinoa' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Mediterranean Fish', 'dinner', 'Bake white fish with tomatoes, olives, and capers.', 30, ['Cod' => 6, 'Cherry tomatoes' => 1, 'Olives' => 0.25, 'Capers' => 1, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Stuffed Peppers', 'dinner', 'Fill peppers with rice, herbs, and ground beef.', 45, ['Bell pepper' => 2, 'Brown rice' => 1, 'Ground beef' => 6, 'Diced tomatoes (canned)' => 0.5, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Lemon Herb Chicken', 'dinner', 'Pan-sear chicken with lemon and fresh herbs.', 30, ['Chicken breast' => 6, 'Lemon' => 1, 'Fresh rosemary' => 1, 'Garlic' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Beef and Vegetable Stir-Fry', 'dinner', 'Stir-fry beef with colorful vegetables and soy sauce.', 25, ['Ground beef' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Baked Tilapia', 'dinner', 'Bake tilapia with lemon, garlic, and fresh herbs.', 25, ['Cod' => 6, 'Lemon' => 0.5, 'Garlic' => 2, 'Fresh dill' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Chicken Shawarma', 'dinner', 'Marinate chicken in Middle Eastern spices and grill.', 35, ['Chicken breast' => 6, 'Cumin' => 0.5, 'Paprika' => 0.5, 'Garlic' => 2, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Vegetable Tagine', 'dinner', 'Slow-cook vegetables with Moroccan spices.', 45, ['Chickpeas' => 1, 'Carrots' => 2, 'Zucchini' => 1, 'Diced tomatoes (canned)' => 1, 'Cumin' => 0.5, 'Turmeric' => 0.5]);
        $this->createRecipe($diet, 'Grilled Steak with Herbs', 'dinner', 'Grill steak and top with fresh herb mixture.', 25, ['Ground beef' => 8, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Garlic' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Salmon with Vegetables', 'dinner', 'Roast salmon with asparagus and lemon.', 30, ['Salmon fillet' => 6, 'Asparagus' => 1, 'Lemon' => 0.5, 'Olive oil' => 2, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Chicken with Olives', 'dinner', 'Braise chicken with olives, tomatoes, and herbs.', 40, ['Chicken breast' => 6, 'Olives' => 0.25, 'Cherry tomatoes' => 1, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Fish with Tahini', 'dinner', 'Bake fish and drizzle with tahini sauce.', 30, ['Cod' => 6, 'Tahini' => 2, 'Lemon' => 0.5, 'Fresh parsley' => 1, 'Garlic' => 2]);
    }

    private function seedHalal(): void
    {
        $diet = Diet::where('slug', 'halal')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Ful Medames', 'breakfast', 'Mash fava beans with olive oil, lemon, and cumin. Serve with pita.', 20, ['Chickpeas' => 1, 'Olive oil' => 2, 'Lemon' => 0.5, 'Cumin' => 0.5, 'Garlic' => 2, 'Whole wheat bread' => 2]);
        $this->createRecipe($diet, 'Labneh with Za\'atar', 'breakfast', 'Spread thick yogurt on a plate with olive oil and Middle Eastern spices.', 5, ['Greek yogurt' => 1, 'Olive oil' => 2, 'Sesame seeds' => 0.5]);
        $this->createRecipe($diet, 'Middle Eastern Eggs', 'breakfast', 'Scramble eggs with tomatoes, onions, and herbs.', 15, ['Eggs' => 3, 'Tomatoes' => 1, 'Onion' => 0.5, 'Fresh parsley' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Cheese Fatayer', 'breakfast', 'Bake pastries filled with cheese and herbs.', 30, ['Feta cheese' => 0.5, 'Fresh mint' => 1, 'Eggs' => 1]);
        $this->createRecipe($diet, 'Foul with Vegetables', 'breakfast', 'Serve mashed beans with diced vegetables and olive oil.', 15, ['Chickpeas' => 1, 'Cucumber' => 0.5, 'Tomatoes' => 1, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Arabic Omelet', 'breakfast', 'Make omelet with onions, tomatoes, and parsley.', 15, ['Eggs' => 3, 'Onion' => 0.5, 'Tomatoes' => 1, 'Fresh parsley' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Date and Nut Oatmeal', 'breakfast', 'Cook oats and top with dates and almonds.', 10, ['Oats' => 0.5, 'Milk' => 1, 'Almonds' => 0.25, 'Honey' => 1]);
        $this->createRecipe($diet, 'Hummus Breakfast Bowl', 'breakfast', 'Top hummus with chickpeas, olive oil, and paprika.', 10, ['Hummus' => 0.5, 'Chickpeas' => 0.25, 'Olive oil' => 2, 'Paprika' => 0.5, 'Whole wheat bread' => 2]);
        $this->createRecipe($diet, 'Shakshuka', 'breakfast', 'Poach eggs in spiced tomato sauce.', 25, ['Eggs' => 2, 'Diced tomatoes (canned)' => 1, 'Bell pepper' => 0.5, 'Onion' => 0.5, 'Cumin' => 0.5, 'Paprika' => 0.5]);
        $this->createRecipe($diet, 'Manakish', 'breakfast', 'Bake flatbread topped with za\'atar and olive oil.', 25, ['Whole wheat bread' => 2, 'Olive oil' => 2, 'Sesame seeds' => 0.5]);
        $this->createRecipe($diet, 'Feta and Olive Plate', 'breakfast', 'Arrange feta cheese with olives, tomatoes, and cucumber.', 5, ['Feta cheese' => 0.5, 'Olives' => 0.25, 'Tomatoes' => 1, 'Cucumber' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Chickpea Scramble', 'breakfast', 'Sauté chickpeas with eggs and Middle Eastern spices.', 15, ['Chickpeas' => 0.5, 'Eggs' => 2, 'Cumin' => 0.5, 'Fresh parsley' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Yogurt with Honey', 'breakfast', 'Top thick yogurt with honey and pistachios.', 5, ['Greek yogurt' => 1, 'Honey' => 1, 'Walnuts' => 0.25]);
        $this->createRecipe($diet, 'Vegetable Frittata', 'breakfast', 'Bake eggs with mixed vegetables and herbs.', 25, ['Eggs' => 3, 'Bell pepper' => 0.5, 'Onion' => 0.5, 'Fresh parsley' => 1, 'Olive oil' => 1]);

        // Lunches (14)
        $this->createRecipe($diet, 'Chicken Shawarma Wrap', 'lunch', 'Fill pita with spiced chicken, tahini, and vegetables.', 25, ['Chicken breast' => 6, 'Whole wheat bread' => 2, 'Tahini' => 2, 'Tomatoes' => 1, 'Cucumber' => 0.5]);
        $this->createRecipe($diet, 'Lamb Kofta Plate', 'lunch', 'Serve grilled lamb kofta with rice and salad.', 30, ['Ground beef' => 6, 'Brown rice' => 1, 'Fresh parsley' => 1, 'Cumin' => 0.5, 'Mixed greens' => 2]);
        $this->createRecipe($diet, 'Falafel Wrap', 'lunch', 'Fill wrap with falafel, hummus, and fresh vegetables.', 30, ['Chickpeas' => 1, 'Whole wheat bread' => 2, 'Hummus' => 0.5, 'Tomatoes' => 1, 'Mixed greens' => 2]);
        $this->createRecipe($diet, 'Grilled Chicken Salad', 'lunch', 'Top mixed greens with grilled chicken and olive oil.', 25, ['Chicken breast' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Hummus and Vegetable Plate', 'lunch', 'Serve hummus with fresh vegetables and warm pita.', 10, ['Hummus' => 0.5, 'Carrots' => 2, 'Cucumber' => 0.5, 'Bell pepper' => 1, 'Whole wheat bread' => 2]);
        $this->createRecipe($diet, 'Beef Kebab Rice Bowl', 'lunch', 'Serve grilled beef kebabs over rice with vegetables.', 30, ['Ground beef' => 6, 'Brown rice' => 1, 'Bell pepper' => 1, 'Onion' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Lentil Soup', 'lunch', 'Simmer lentils with vegetables and cumin.', 40, ['Lentils' => 1, 'Carrots' => 2, 'Onion' => 0.5, 'Cumin' => 0.5, 'Vegetable broth' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Tabbouleh Salad', 'lunch', 'Mix bulgur with fresh herbs, tomatoes, and lemon.', 20, ['Quinoa' => 1, 'Fresh parsley' => 2, 'Fresh mint' => 1, 'Tomatoes' => 1, 'Lemon' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Grilled Fish Plate', 'lunch', 'Grill fish with lemon and herbs. Serve with rice.', 25, ['Salmon fillet' => 6, 'Brown rice' => 1, 'Lemon' => 0.5, 'Fresh dill' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Stuffed Grape Leaves', 'lunch', 'Serve grape leaves stuffed with rice and herbs.', 15, ['Brown rice' => 1, 'Fresh parsley' => 1, 'Fresh mint' => 1, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Chicken and Rice', 'lunch', 'Serve roasted chicken over spiced rice.', 40, ['Chicken breast' => 6, 'Brown rice' => 1, 'Cumin' => 0.5, 'Turmeric' => 0.5, 'Onion' => 0.5]);
        $this->createRecipe($diet, 'Fattoush Salad', 'lunch', 'Toss crispy pita with fresh vegetables and sumac dressing.', 20, ['Romaine lettuce' => 0.5, 'Tomatoes' => 1, 'Cucumber' => 0.5, 'Whole wheat bread' => 1, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Beef and Vegetable Stew', 'lunch', 'Simmer beef with vegetables in aromatic broth.', 60, ['Ground beef' => 6, 'Carrots' => 2, 'Onion' => 0.5, 'Diced tomatoes (canned)' => 1, 'Chicken broth' => 2]);
        $this->createRecipe($diet, 'Baba Ganoush Plate', 'lunch', 'Serve smoky eggplant dip with vegetables and pita.', 30, ['Eggplant' => 1, 'Tahini' => 2, 'Garlic' => 2, 'Lemon' => 0.5, 'Whole wheat bread' => 2]);

        // Dinners (14)
        $this->createRecipe($diet, 'Lamb Tagine', 'dinner', 'Slow-cook lamb with apricots and Moroccan spices.', 90, ['Ground beef' => 8, 'Carrots' => 2, 'Onion' => 0.5, 'Cumin' => 0.5, 'Cinnamon' => 0.5, 'Honey' => 1]);
        $this->createRecipe($diet, 'Chicken Biryani', 'dinner', 'Layer spiced rice with tender chicken and aromatic spices.', 60, ['Chicken breast' => 6, 'Brown rice' => 1, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Cinnamon' => 0.25, 'Greek yogurt' => 0.25]);
        $this->createRecipe($diet, 'Grilled Lamb Chops', 'dinner', 'Grill lamb chops with herbs and serve with vegetables.', 30, ['Ground beef' => 8, 'Fresh rosemary' => 1, 'Garlic' => 2, 'Olive oil' => 2, 'Asparagus' => 0.5]);
        $this->createRecipe($diet, 'Beef Kofta with Rice', 'dinner', 'Grill spiced beef kofta and serve over rice.', 30, ['Ground beef' => 6, 'Brown rice' => 1, 'Fresh parsley' => 1, 'Cumin' => 0.5, 'Onion' => 0.5]);
        $this->createRecipe($diet, 'Baked Fish with Tahini', 'dinner', 'Bake fish and top with tahini sauce.', 30, ['Cod' => 6, 'Tahini' => 2, 'Lemon' => 0.5, 'Fresh parsley' => 1, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Chicken Kebabs', 'dinner', 'Grill marinated chicken kebabs with vegetables.', 30, ['Chicken breast' => 6, 'Bell pepper' => 1, 'Onion' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Lamb and Vegetable Stew', 'dinner', 'Braise lamb with root vegetables and herbs.', 90, ['Ground beef' => 8, 'Carrots' => 2, 'Onion' => 0.5, 'Sweet potato' => 1, 'Chicken broth' => 2]);
        $this->createRecipe($diet, 'Grilled Salmon', 'dinner', 'Grill salmon with olive oil and herbs.', 25, ['Salmon fillet' => 6, 'Olive oil' => 2, 'Lemon' => 0.5, 'Fresh dill' => 1, 'Quinoa' => 1]);
        $this->createRecipe($diet, 'Stuffed Zucchini', 'dinner', 'Fill zucchini with spiced rice and meat.', 45, ['Zucchini' => 2, 'Brown rice' => 1, 'Ground beef' => 4, 'Diced tomatoes (canned)' => 0.5, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Chicken Shawarma Plate', 'dinner', 'Serve sliced shawarma chicken with rice and salad.', 35, ['Chicken breast' => 6, 'Brown rice' => 1, 'Mixed greens' => 2, 'Tahini' => 2, 'Cumin' => 0.5]);
        $this->createRecipe($diet, 'Fish Curry', 'dinner', 'Simmer fish in aromatic curry sauce.', 30, ['Cod' => 6, 'Coconut milk' => 1, 'Diced tomatoes (canned)' => 0.5, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Beef and Rice Pilaf', 'dinner', 'Cook rice with spiced beef and vegetables.', 45, ['Ground beef' => 6, 'Brown rice' => 1, 'Onion' => 0.5, 'Cumin' => 0.5, 'Cinnamon' => 0.25, 'Almonds' => 0.25]);
        $this->createRecipe($diet, 'Roasted Chicken', 'dinner', 'Roast whole chicken with Middle Eastern spices.', 60, ['Chicken breast' => 8, 'Cumin' => 0.5, 'Paprika' => 0.5, 'Garlic' => 4, 'Olive oil' => 2, 'Lemon' => 1]);
        $this->createRecipe($diet, 'Lamb Kebab Plate', 'dinner', 'Grill lamb kebabs and serve with flatbread.', 30, ['Ground beef' => 8, 'Whole wheat bread' => 2, 'Fresh parsley' => 1, 'Onion' => 0.5, 'Olive oil' => 2]);
    }

    private function seedVegan(): void
    {
        $diet = Diet::where('slug', 'vegan')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Avocado Toast', 'breakfast', 'Top toasted bread with mashed avocado, lime, and chili flakes.', 10, ['Whole wheat bread' => 2, 'Avocado' => 0.5, 'Lime' => 0.5, 'Sea salt' => 0.25]);
        $this->createRecipe($diet, 'Chia Pudding', 'breakfast', 'Soak chia seeds in almond milk overnight. Top with berries.', 5, ['Chia seeds' => 2, 'Almond milk' => 1, 'Blueberries' => 0.5, 'Maple syrup' => 1]);
        $this->createRecipe($diet, 'Tofu Scramble', 'breakfast', 'Crumble tofu and sauté with turmeric and vegetables.', 15, ['Tofu' => 8, 'Turmeric' => 0.5, 'Bell pepper' => 0.5, 'Onion' => 0.5, 'Spinach' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Smoothie Bowl', 'breakfast', 'Blend frozen berries with banana. Top with granola and seeds.', 10, ['Banana' => 1, 'Blueberries' => 0.5, 'Almond milk' => 0.5, 'Chia seeds' => 1]);
        $this->createRecipe($diet, 'Overnight Oats', 'breakfast', 'Soak oats in almond milk with chia seeds and fruit.', 5, ['Oats' => 0.5, 'Almond milk' => 1, 'Chia seeds' => 1, 'Strawberries' => 0.5, 'Maple syrup' => 1]);
        $this->createRecipe($diet, 'Green Smoothie', 'breakfast', 'Blend spinach, banana, and almond butter with almond milk.', 5, ['Spinach' => 2, 'Banana' => 1, 'Almond butter' => 1, 'Almond milk' => 1]);
        $this->createRecipe($diet, 'Banana Pancakes', 'breakfast', 'Make vegan pancakes with mashed banana and oat flour.', 20, ['Banana' => 1, 'Oats' => 0.5, 'Almond milk' => 0.5, 'Maple syrup' => 1]);
        $this->createRecipe($diet, 'Fruit and Nut Bowl', 'breakfast', 'Combine fresh fruit with almonds and coconut.', 5, ['Banana' => 0.5, 'Blueberries' => 0.5, 'Strawberries' => 0.5, 'Almonds' => 0.25, 'Coconut milk' => 0.25]);
        $this->createRecipe($diet, 'Peanut Butter Toast', 'breakfast', 'Spread peanut butter on toast and top with banana slices.', 5, ['Whole wheat bread' => 2, 'Peanut butter' => 2, 'Banana' => 0.5]);
        $this->createRecipe($diet, 'Coconut Yogurt Parfait', 'breakfast', 'Layer coconut yogurt with granola and fresh berries.', 5, ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Strawberries' => 0.5]);
        $this->createRecipe($diet, 'Hash Brown Bowl', 'breakfast', 'Serve crispy hash browns with avocado and salsa.', 25, ['Sweet potato' => 1, 'Avocado' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Oatmeal with Berries', 'breakfast', 'Cook oats and top with mixed berries and maple syrup.', 10, ['Oats' => 0.5, 'Almond milk' => 1, 'Blueberries' => 0.5, 'Maple syrup' => 1]);
        $this->createRecipe($diet, 'Tropical Smoothie', 'breakfast', 'Blend mango, pineapple, and coconut milk.', 5, ['Banana' => 0.5, 'Coconut milk' => 1]);
        $this->createRecipe($diet, 'Almond Butter Banana', 'breakfast', 'Top banana with almond butter and chia seeds.', 5, ['Banana' => 1, 'Almond butter' => 2, 'Chia seeds' => 1]);

        // Lunches (14)
        $this->createRecipe($diet, 'Buddha Bowl', 'lunch', 'Arrange quinoa, roasted vegetables, chickpeas, and tahini dressing.', 30, ['Quinoa' => 1, 'Chickpeas' => 0.5, 'Sweet potato' => 0.5, 'Kale' => 0.5, 'Tahini' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Lentil Soup', 'lunch', 'Simmer lentils with vegetables and cumin.', 40, ['Lentils' => 1, 'Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Cumin' => 0.5, 'Vegetable broth' => 2]);
        $this->createRecipe($diet, 'Veggie Wrap', 'lunch', 'Fill wrap with hummus, avocado, and fresh vegetables.', 15, ['Whole wheat bread' => 2, 'Hummus' => 0.5, 'Avocado' => 0.5, 'Mixed greens' => 2, 'Cucumber' => 0.5, 'Bell pepper' => 0.5]);
        $this->createRecipe($diet, 'Quinoa Salad', 'lunch', 'Toss quinoa with cucumber, tomatoes, and lemon dressing.', 20, ['Quinoa' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Fresh parsley' => 1, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Black Bean Tacos', 'lunch', 'Fill corn tortillas with seasoned black beans and salsa.', 20, ['Black beans' => 1, 'Avocado' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Fresh cilantro' => 1, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Minestrone Soup', 'lunch', 'Simmer vegetables and beans in tomato broth.', 40, ['Diced tomatoes (canned)' => 1, 'White beans' => 0.5, 'Carrots' => 2, 'Celery' => 2, 'Vegetable broth' => 2, 'Italian seasoning' => 0.5]);
        $this->createRecipe($diet, 'Falafel Salad', 'lunch', 'Serve baked falafel over mixed greens with tahini.', 30, ['Chickpeas' => 1, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Tahini' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Asian Noodle Bowl', 'lunch', 'Toss rice noodles with vegetables and peanut sauce.', 25, ['Rice noodles' => 1, 'Carrots' => 1, 'Bell pepper' => 0.5, 'Peanut butter' => 1, 'Soy sauce' => 1, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Stuffed Sweet Potato', 'lunch', 'Fill baked sweet potato with black beans and avocado.', 45, ['Sweet potato' => 1, 'Black beans' => 0.5, 'Avocado' => 0.5, 'Fresh cilantro' => 1, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Mediterranean Plate', 'lunch', 'Arrange hummus, falafel, vegetables, and pita.', 20, ['Hummus' => 0.5, 'Chickpeas' => 0.5, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Whole wheat bread' => 2, 'Olives' => 0.25]);
        $this->createRecipe($diet, 'Cauliflower Fried Rice', 'lunch', 'Stir-fry cauliflower rice with vegetables and soy sauce.', 20, ['Cauliflower' => 0.5, 'Carrots' => 1, 'Bell pepper' => 0.5, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Chickpea Curry', 'lunch', 'Simmer chickpeas in coconut curry sauce.', 30, ['Chickpeas' => 1, 'Coconut milk' => 1, 'Diced tomatoes (canned)' => 0.5, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Veggie Stir-Fry', 'lunch', 'Stir-fry tofu and vegetables in ginger sauce.', 25, ['Tofu' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Greek Salad (Vegan)', 'lunch', 'Toss cucumber, tomatoes, and olives with olive oil.', 15, ['Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olives' => 0.25, 'Red onion' => 0.25, 'Olive oil' => 2, 'Lemon' => 0.5]);

        // Dinners (14)
        $this->createRecipe($diet, 'Vegetable Curry', 'dinner', 'Simmer vegetables in coconut curry sauce. Serve over rice.', 35, ['Cauliflower' => 0.25, 'Chickpeas' => 0.5, 'Coconut milk' => 1, 'Diced tomatoes (canned)' => 0.5, 'Turmeric' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Stuffed Peppers', 'dinner', 'Fill peppers with quinoa, black beans, and vegetables.', 45, ['Bell pepper' => 2, 'Quinoa' => 1, 'Black beans' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Cumin' => 0.5]);
        $this->createRecipe($diet, 'Mushroom Stir-Fry', 'dinner', 'Stir-fry mushrooms with vegetables and garlic sauce.', 25, ['Mushrooms' => 8, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Soy sauce' => 1, 'Garlic' => 3, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Lentil Bolognese', 'dinner', 'Simmer lentils in tomato sauce. Serve over pasta.', 40, ['Lentils' => 1, 'Diced tomatoes (canned)' => 1, 'Carrots' => 1, 'Celery' => 1, 'Whole wheat pasta' => 1, 'Italian seasoning' => 0.5]);
        $this->createRecipe($diet, 'Thai Coconut Curry', 'dinner', 'Simmer tofu and vegetables in Thai curry sauce.', 30, ['Tofu' => 8, 'Coconut milk' => 1, 'Bell pepper' => 1, 'Broccoli' => 0.5, 'Ginger' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Black Bean Burgers', 'dinner', 'Make patties from black beans and spices. Serve with salad.', 30, ['Black beans' => 1, 'Oats' => 0.25, 'Cumin' => 0.5, 'Mixed greens' => 2, 'Avocado' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Paella', 'dinner', 'Cook rice with vegetables and saffron.', 45, ['Brown rice' => 1, 'Bell pepper' => 1, 'Chickpeas' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Turmeric' => 0.5, 'Vegetable broth' => 1]);
        $this->createRecipe($diet, 'Cauliflower Tacos', 'dinner', 'Roast spiced cauliflower and serve in corn tortillas.', 30, ['Cauliflower' => 0.5, 'Cumin' => 0.5, 'Paprika' => 0.5, 'Avocado' => 0.5, 'Fresh cilantro' => 1, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Eggplant Curry', 'dinner', 'Simmer eggplant in spiced tomato sauce.', 35, ['Eggplant' => 1, 'Diced tomatoes (canned)' => 1, 'Coconut milk' => 0.5, 'Cumin' => 0.5, 'Turmeric' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Veggie Pad Thai', 'dinner', 'Stir-fry rice noodles with tofu and vegetables.', 30, ['Rice noodles' => 1, 'Tofu' => 6, 'Bean sprouts' => 1, 'Peanut butter' => 1, 'Soy sauce' => 1, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Mediterranean Bowl', 'dinner', 'Arrange quinoa, roasted vegetables, and hummus.', 30, ['Quinoa' => 1, 'Zucchini' => 1, 'Bell pepper' => 1, 'Hummus' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Sweet Potato Curry', 'dinner', 'Simmer sweet potato and chickpeas in curry sauce.', 35, ['Sweet potato' => 1, 'Chickpeas' => 0.5, 'Coconut milk' => 1, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Zucchini Noodles', 'dinner', 'Spiralize zucchini and toss with marinara and vegetables.', 25, ['Zucchini' => 2, 'Diced tomatoes (canned)' => 1, 'Mushrooms' => 4, 'Garlic' => 2, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Burrito Bowl', 'dinner', 'Layer rice, black beans, corn, and avocado.', 25, ['Brown rice' => 1, 'Black beans' => 0.5, 'Avocado' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Fresh cilantro' => 1, 'Lime' => 0.5]);
    }

    private function seedPaleo(): void
    {
        $diet = Diet::where('slug', 'paleo')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Bacon and Eggs', 'breakfast', 'Fry bacon until crispy. Cook eggs in the fat. Serve with avocado.', 15, ['Bacon' => 4, 'Eggs' => 3, 'Avocado' => 0.5]);
        $this->createRecipe($diet, 'Sweet Potato Hash', 'breakfast', 'Sauté diced sweet potato with onions and peppers. Top with eggs.', 25, ['Sweet potato' => 1, 'Onion' => 0.5, 'Bell pepper' => 0.5, 'Eggs' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Banana Almond Pancakes', 'breakfast', 'Make pancakes from mashed banana, eggs, and almond flour.', 20, ['Banana' => 1, 'Eggs' => 2, 'Almond flour' => 0.25, 'Coconut milk' => 0.25]);
        $this->createRecipe($diet, 'Smoked Salmon Plate', 'breakfast', 'Serve smoked salmon with avocado and capers.', 10, ['Salmon fillet' => 4, 'Avocado' => 0.5, 'Capers' => 1, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Vegetable Frittata', 'breakfast', 'Bake eggs with spinach, mushrooms, and onions.', 25, ['Eggs' => 4, 'Spinach' => 2, 'Mushrooms' => 4, 'Onion' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Coconut Berry Bowl', 'breakfast', 'Top coconut milk with fresh berries and nuts.', 5, ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Strawberries' => 0.5, 'Almonds' => 0.25]);
        $this->createRecipe($diet, 'Sausage and Greens', 'breakfast', 'Serve grilled sausage with sautéed kale and eggs.', 20, ['Pork tenderloin' => 4, 'Kale' => 0.5, 'Eggs' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Egg Muffins', 'breakfast', 'Bake eggs with vegetables in muffin tins.', 30, ['Eggs' => 4, 'Bell pepper' => 0.5, 'Spinach' => 1, 'Bacon' => 2]);
        $this->createRecipe($diet, 'Avocado Stuffed with Egg', 'breakfast', 'Bake eggs inside avocado halves.', 25, ['Avocado' => 1, 'Eggs' => 2, 'Sea salt' => 0.25, 'Fresh cilantro' => 1]);
        $this->createRecipe($diet, 'Fruit and Nut Plate', 'breakfast', 'Arrange fresh fruit with mixed nuts and coconut.', 5, ['Banana' => 0.5, 'Blueberries' => 0.5, 'Almonds' => 0.25, 'Walnuts' => 0.25]);
        $this->createRecipe($diet, 'Steak and Eggs', 'breakfast', 'Pan-sear steak and serve with fried eggs.', 20, ['Ground beef' => 4, 'Eggs' => 2, 'Butter' => 1, 'Sea salt' => 0.25]);
        $this->createRecipe($diet, 'Green Smoothie', 'breakfast', 'Blend spinach, banana, and coconut milk.', 5, ['Spinach' => 2, 'Banana' => 1, 'Coconut milk' => 1]);
        $this->createRecipe($diet, 'Prosciutto Wrapped Melon', 'breakfast', 'Wrap melon with prosciutto. Serve with mixed nuts.', 10, ['Bacon' => 3, 'Almonds' => 0.25]);
        $this->createRecipe($diet, 'Scrambled Eggs with Herbs', 'breakfast', 'Scramble eggs with fresh herbs and serve with avocado.', 10, ['Eggs' => 3, 'Fresh parsley' => 1, 'Fresh basil' => 1, 'Avocado' => 0.5, 'Butter' => 1]);

        // Lunches (14)
        $this->createRecipe($diet, 'Grilled Chicken Salad', 'lunch', 'Top mixed greens with grilled chicken and olive oil dressing.', 25, ['Chicken breast' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Beef Lettuce Wraps', 'lunch', 'Fill lettuce cups with seasoned ground beef.', 20, ['Ground beef' => 6, 'Romaine lettuce' => 0.5, 'Onion' => 0.5, 'Garlic' => 2, 'Fresh cilantro' => 1]);
        $this->createRecipe($diet, 'Salmon Avocado Bowl', 'lunch', 'Top cauliflower rice with grilled salmon and avocado.', 25, ['Salmon fillet' => 6, 'Cauliflower' => 0.5, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Stuffed Avocado', 'lunch', 'Fill avocado halves with seasoned chicken salad.', 15, ['Avocado' => 1, 'Chicken breast' => 4, 'Fresh cilantro' => 1, 'Lime' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Vegetable Soup', 'lunch', 'Simmer vegetables in bone broth.', 40, ['Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Chicken broth' => 2, 'Fresh thyme' => 1]);
        $this->createRecipe($diet, 'BLT Lettuce Wraps', 'lunch', 'Wrap bacon, tomato, and avocado in lettuce.', 15, ['Bacon' => 4, 'Tomatoes' => 1, 'Romaine lettuce' => 0.5, 'Avocado' => 0.5]);
        $this->createRecipe($diet, 'Tuna Stuffed Tomatoes', 'lunch', 'Fill tomatoes with seasoned tuna salad.', 15, ['Tuna' => 5, 'Tomatoes' => 2, 'Olive oil' => 1, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Chicken and Vegetable Stir-Fry', 'lunch', 'Stir-fry chicken with vegetables in coconut aminos.', 25, ['Chicken breast' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 1, 'Ginger' => 0.5]);
        $this->createRecipe($diet, 'Shrimp and Avocado Salad', 'lunch', 'Toss grilled shrimp with avocado and mixed greens.', 20, ['Shrimp' => 6, 'Avocado' => 0.5, 'Mixed greens' => 3, 'Lime' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Egg Salad Lettuce Cups', 'lunch', 'Serve egg salad in crisp lettuce cups.', 15, ['Eggs' => 4, 'Romaine lettuce' => 0.5, 'Dijon mustard' => 0.5, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Cauliflower Fried Rice', 'lunch', 'Stir-fry cauliflower rice with eggs and vegetables.', 20, ['Cauliflower' => 0.5, 'Eggs' => 2, 'Carrots' => 1, 'Coconut aminos' => 1, 'Ginger' => 0.5]);
        $this->createRecipe($diet, 'Lamb Burger Patties', 'lunch', 'Grill lamb patties and serve with salad.', 20, ['Ground beef' => 6, 'Mixed greens' => 2, 'Avocado' => 0.5, 'Tomatoes' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Zucchini Noodle Salad', 'lunch', 'Spiralize zucchini and toss with olive oil and herbs.', 15, ['Zucchini' => 2, 'Cherry tomatoes' => 0.5, 'Fresh basil' => 1, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Smoked Salmon Salad', 'lunch', 'Top greens with smoked salmon and capers.', 10, ['Salmon fillet' => 6, 'Mixed greens' => 3, 'Capers' => 1, 'Fresh dill' => 1, 'Olive oil' => 2]);

        // Dinners (14)
        $this->createRecipe($diet, 'Grilled Steak with Vegetables', 'dinner', 'Grill steak and serve with roasted vegetables.', 30, ['Ground beef' => 8, 'Asparagus' => 0.5, 'Bell pepper' => 1, 'Olive oil' => 2, 'Fresh rosemary' => 1]);
        $this->createRecipe($diet, 'Roasted Chicken', 'dinner', 'Roast chicken with herbs and serve with vegetables.', 60, ['Chicken breast' => 8, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Garlic' => 4, 'Carrots' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Salmon with Asparagus', 'dinner', 'Bake salmon with asparagus and lemon.', 25, ['Salmon fillet' => 6, 'Asparagus' => 1, 'Lemon' => 0.5, 'Olive oil' => 2, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Pork Chops with Apples', 'dinner', 'Pan-sear pork chops and serve with sautéed apples.', 30, ['Pork tenderloin' => 6, 'Onion' => 0.5, 'Fresh rosemary' => 1, 'Butter' => 2]);
        $this->createRecipe($diet, 'Shrimp Stir-Fry', 'dinner', 'Stir-fry shrimp with vegetables in coconut aminos.', 20, ['Shrimp' => 8, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 1, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Lamb Chops with Herbs', 'dinner', 'Grill lamb chops with fresh herbs and garlic.', 25, ['Ground beef' => 8, 'Fresh rosemary' => 1, 'Fresh mint' => 1, 'Garlic' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Baked Cod with Vegetables', 'dinner', 'Bake cod with tomatoes and zucchini.', 25, ['Cod' => 6, 'Cherry tomatoes' => 0.5, 'Zucchini' => 1, 'Olive oil' => 2, 'Fresh basil' => 1]);
        $this->createRecipe($diet, 'Beef Stir-Fry', 'dinner', 'Stir-fry sliced beef with vegetables.', 25, ['Ground beef' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 1, 'Ginger' => 0.5]);
        $this->createRecipe($diet, 'Turkey Meatballs', 'dinner', 'Bake turkey meatballs and serve with vegetables.', 35, ['Ground turkey' => 6, 'Eggs' => 1, 'Fresh parsley' => 1, 'Garlic' => 2, 'Zucchini' => 1]);
        $this->createRecipe($diet, 'Grilled Swordfish', 'dinner', 'Grill swordfish with lemon and herbs.', 25, ['Cod' => 6, 'Lemon' => 0.5, 'Fresh rosemary' => 1, 'Olive oil' => 2, 'Asparagus' => 0.5]);
        $this->createRecipe($diet, 'Stuffed Zucchini Boats', 'dinner', 'Fill zucchini with ground beef and vegetables.', 40, ['Zucchini' => 2, 'Ground beef' => 6, 'Diced tomatoes (canned)' => 0.5, 'Onion' => 0.5, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Chicken Curry', 'dinner', 'Simmer chicken in coconut curry sauce.', 35, ['Chicken breast' => 6, 'Coconut milk' => 1, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Cauliflower' => 0.5]);
        $this->createRecipe($diet, 'Grilled Salmon', 'dinner', 'Grill salmon with herbs and serve with sweet potato.', 30, ['Salmon fillet' => 6, 'Sweet potato' => 1, 'Fresh dill' => 1, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Pork Stir-Fry', 'dinner', 'Stir-fry pork with vegetables in ginger sauce.', 25, ['Pork tenderloin' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Ginger' => 0.5, 'Coconut aminos' => 1]);
    }

    private function seedWhole30(): void
    {
        $diet = Diet::where('slug', 'whole30')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Eggs with Vegetables', 'breakfast', 'Scramble eggs with spinach, tomatoes, and mushrooms.', 15, ['Eggs' => 3, 'Spinach' => 2, 'Cherry tomatoes' => 0.5, 'Mushrooms' => 4, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Breakfast Hash', 'breakfast', 'Sauté sweet potato, onions, and peppers. Top with eggs.', 25, ['Sweet potato' => 1, 'Onion' => 0.5, 'Bell pepper' => 0.5, 'Eggs' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Bacon and Avocado Plate', 'breakfast', 'Serve crispy bacon with sliced avocado and eggs.', 15, ['Bacon' => 4, 'Avocado' => 0.5, 'Eggs' => 2]);
        $this->createRecipe($diet, 'Smoked Salmon with Vegetables', 'breakfast', 'Serve smoked salmon with cucumber and avocado.', 10, ['Salmon fillet' => 4, 'Cucumber' => 0.5, 'Avocado' => 0.5, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Sausage and Greens', 'breakfast', 'Serve sausage with sautéed kale and eggs.', 20, ['Pork tenderloin' => 4, 'Kale' => 0.5, 'Eggs' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Egg Muffins', 'breakfast', 'Bake eggs with vegetables in muffin tins.', 30, ['Eggs' => 4, 'Bell pepper' => 0.5, 'Spinach' => 1, 'Bacon' => 2]);
        $this->createRecipe($diet, 'Plantain Pancakes', 'breakfast', 'Make pancakes from mashed plantain and eggs.', 20, ['Banana' => 1, 'Eggs' => 2, 'Coconut milk' => 0.25]);
        $this->createRecipe($diet, 'Vegetable Frittata', 'breakfast', 'Bake eggs with zucchini, onions, and herbs.', 25, ['Eggs' => 4, 'Zucchini' => 0.5, 'Onion' => 0.5, 'Fresh parsley' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Steak and Eggs', 'breakfast', 'Pan-sear steak and serve with eggs.', 20, ['Ground beef' => 4, 'Eggs' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Coconut Milk Smoothie', 'breakfast', 'Blend coconut milk with berries and spinach.', 5, ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Spinach' => 1, 'Banana' => 0.5]);
        $this->createRecipe($diet, 'Avocado and Egg Bowl', 'breakfast', 'Mash avocado and top with fried eggs.', 10, ['Avocado' => 1, 'Eggs' => 2, 'Sea salt' => 0.25, 'Fresh cilantro' => 1]);
        $this->createRecipe($diet, 'Turkey Sausage Patties', 'breakfast', 'Make sausage patties from ground turkey and herbs.', 20, ['Ground turkey' => 4, 'Fresh thyme' => 1, 'Eggs' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Shrimp and Vegetables', 'breakfast', 'Sauté shrimp with vegetables and serve with avocado.', 20, ['Shrimp' => 4, 'Bell pepper' => 0.5, 'Onion' => 0.5, 'Avocado' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Sweet Potato Toast', 'breakfast', 'Slice and toast sweet potato. Top with avocado and eggs.', 20, ['Sweet potato' => 1, 'Avocado' => 0.5, 'Eggs' => 2]);

        // Lunches (14)
        $this->createRecipe($diet, 'Chicken Salad', 'lunch', 'Top mixed greens with grilled chicken and olive oil.', 25, ['Chicken breast' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Beef Lettuce Wraps', 'lunch', 'Fill lettuce cups with seasoned ground beef.', 20, ['Ground beef' => 6, 'Romaine lettuce' => 0.5, 'Onion' => 0.5, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Salmon and Vegetables', 'lunch', 'Serve grilled salmon with roasted vegetables.', 30, ['Salmon fillet' => 6, 'Zucchini' => 1, 'Bell pepper' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Turkey and Avocado Wrap', 'lunch', 'Wrap turkey and avocado in lettuce leaves.', 10, ['Ground turkey' => 6, 'Romaine lettuce' => 0.5, 'Avocado' => 0.5, 'Tomatoes' => 1]);
        $this->createRecipe($diet, 'Vegetable Soup', 'lunch', 'Simmer vegetables in bone broth.', 40, ['Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Chicken broth' => 2, 'Fresh thyme' => 1]);
        $this->createRecipe($diet, 'Tuna Stuffed Avocado', 'lunch', 'Fill avocado halves with seasoned tuna.', 15, ['Tuna' => 5, 'Avocado' => 1, 'Olive oil' => 1, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Chicken Stir-Fry', 'lunch', 'Stir-fry chicken with vegetables in coconut aminos.', 25, ['Chicken breast' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 1]);
        $this->createRecipe($diet, 'Shrimp Salad', 'lunch', 'Top mixed greens with grilled shrimp.', 20, ['Shrimp' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Olive oil' => 2, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Egg Salad Cups', 'lunch', 'Serve egg salad in lettuce cups.', 15, ['Eggs' => 4, 'Romaine lettuce' => 0.5, 'Dijon mustard' => 0.5, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Cauliflower Rice Bowl', 'lunch', 'Top cauliflower rice with grilled chicken and vegetables.', 25, ['Cauliflower' => 0.5, 'Chicken breast' => 4, 'Bell pepper' => 0.5, 'Coconut aminos' => 1]);
        $this->createRecipe($diet, 'BLT Lettuce Wraps', 'lunch', 'Wrap bacon, tomato, and avocado in lettuce.', 15, ['Bacon' => 4, 'Tomatoes' => 1, 'Romaine lettuce' => 0.5, 'Avocado' => 0.5]);
        $this->createRecipe($diet, 'Zucchini Noodles with Chicken', 'lunch', 'Serve spiralized zucchini with grilled chicken.', 20, ['Zucchini' => 2, 'Chicken breast' => 4, 'Olive oil' => 2, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Sweet Potato and Turkey', 'lunch', 'Serve baked sweet potato with ground turkey.', 35, ['Sweet potato' => 1, 'Ground turkey' => 4, 'Fresh cilantro' => 1, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Salmon Salad', 'lunch', 'Top mixed greens with salmon and olive oil.', 20, ['Salmon fillet' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Olive oil' => 2]);

        // Dinners (14)
        $this->createRecipe($diet, 'Grilled Steak', 'dinner', 'Grill steak and serve with roasted vegetables.', 30, ['Ground beef' => 8, 'Asparagus' => 0.5, 'Bell pepper' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Roasted Chicken', 'dinner', 'Roast chicken with herbs and vegetables.', 60, ['Chicken breast' => 8, 'Fresh rosemary' => 1, 'Fresh thyme' => 1, 'Carrots' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Salmon with Vegetables', 'dinner', 'Bake salmon with asparagus and lemon.', 25, ['Salmon fillet' => 6, 'Asparagus' => 1, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Pork Tenderloin', 'dinner', 'Roast pork tenderloin with herbs and sweet potato.', 40, ['Pork tenderloin' => 6, 'Sweet potato' => 1, 'Fresh rosemary' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Shrimp Stir-Fry', 'dinner', 'Stir-fry shrimp with vegetables in coconut aminos.', 20, ['Shrimp' => 8, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 1]);
        $this->createRecipe($diet, 'Turkey Meatballs', 'dinner', 'Bake turkey meatballs and serve with vegetables.', 35, ['Ground turkey' => 6, 'Eggs' => 1, 'Fresh parsley' => 1, 'Zucchini' => 1]);
        $this->createRecipe($diet, 'Beef Stir-Fry', 'dinner', 'Stir-fry beef with vegetables in ginger sauce.', 25, ['Ground beef' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Ginger' => 0.5, 'Coconut aminos' => 1]);
        $this->createRecipe($diet, 'Baked Cod', 'dinner', 'Bake cod with tomatoes and herbs.', 25, ['Cod' => 6, 'Cherry tomatoes' => 0.5, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Lamb Chops', 'dinner', 'Grill lamb chops with rosemary and garlic.', 25, ['Ground beef' => 8, 'Fresh rosemary' => 1, 'Garlic' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Stuffed Peppers', 'dinner', 'Fill peppers with ground beef and vegetables.', 45, ['Bell pepper' => 2, 'Ground beef' => 6, 'Diced tomatoes (canned)' => 0.5, 'Onion' => 0.5]);
        $this->createRecipe($diet, 'Chicken Curry', 'dinner', 'Simmer chicken in coconut curry sauce.', 35, ['Chicken breast' => 6, 'Coconut milk' => 1, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Cauliflower' => 0.5]);
        $this->createRecipe($diet, 'Grilled Salmon', 'dinner', 'Grill salmon with herbs and vegetables.', 25, ['Salmon fillet' => 6, 'Zucchini' => 1, 'Fresh dill' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Pork Stir-Fry', 'dinner', 'Stir-fry pork with vegetables.', 25, ['Pork tenderloin' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Coconut aminos' => 1]);
        $this->createRecipe($diet, 'Zucchini Boats', 'dinner', 'Fill zucchini with ground beef and vegetables.', 40, ['Zucchini' => 2, 'Ground beef' => 6, 'Diced tomatoes (canned)' => 0.5, 'Onion' => 0.5]);
    }

    private function seedLowFodmap(): void
    {
        $diet = Diet::where('slug', 'low-fodmap')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Eggs with Spinach', 'breakfast', 'Scramble eggs with baby spinach and chives.', 10, ['Eggs' => 2, 'Spinach' => 2, 'Butter' => 1]);
        $this->createRecipe($diet, 'Oatmeal with Blueberries', 'breakfast', 'Cook gluten-free oats with blueberries and maple syrup.', 10, ['Gluten-free oats' => 0.5, 'Almond milk' => 1, 'Blueberries' => 0.5, 'Maple syrup' => 1]);
        $this->createRecipe($diet, 'Rice Porridge', 'breakfast', 'Cook rice in almond milk until creamy. Top with strawberries.', 20, ['Brown rice' => 0.5, 'Almond milk' => 1, 'Strawberries' => 0.5, 'Maple syrup' => 1]);
        $this->createRecipe($diet, 'Bacon and Eggs', 'breakfast', 'Fry bacon and eggs. Serve with sautéed spinach.', 15, ['Bacon' => 3, 'Eggs' => 2, 'Spinach' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Banana Smoothie', 'breakfast', 'Blend unripe banana with almond milk and peanut butter.', 5, ['Banana' => 0.5, 'Almond milk' => 1, 'Peanut butter' => 1]);
        $this->createRecipe($diet, 'Chia Pudding', 'breakfast', 'Soak chia seeds in almond milk. Top with kiwi.', 5, ['Chia seeds' => 2, 'Almond milk' => 1, 'Maple syrup' => 1]);
        $this->createRecipe($diet, 'Potato Hash', 'breakfast', 'Sauté diced potatoes with bell peppers. Top with eggs.', 25, ['Sweet potato' => 1, 'Bell pepper' => 0.5, 'Eggs' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Smoked Salmon Plate', 'breakfast', 'Serve smoked salmon with cucumber and dill.', 10, ['Salmon fillet' => 4, 'Cucumber' => 0.5, 'Fresh dill' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Egg Muffins', 'breakfast', 'Bake eggs with bell peppers and spinach.', 30, ['Eggs' => 4, 'Bell pepper' => 0.5, 'Spinach' => 1]);
        $this->createRecipe($diet, 'Peanut Butter Toast', 'breakfast', 'Spread peanut butter on gluten-free toast.', 5, ['Whole wheat bread' => 2, 'Peanut butter' => 2, 'Banana' => 0.5]);
        $this->createRecipe($diet, 'Scrambled Eggs', 'breakfast', 'Scramble eggs with herbs and serve with tomatoes.', 10, ['Eggs' => 3, 'Fresh parsley' => 1, 'Cherry tomatoes' => 0.5, 'Butter' => 1]);
        $this->createRecipe($diet, 'Coconut Yogurt Bowl', 'breakfast', 'Top coconut yogurt with blueberries and walnuts.', 5, ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Walnuts' => 0.25]);
        $this->createRecipe($diet, 'Rice Cakes with Almond Butter', 'breakfast', 'Spread almond butter on rice cakes.', 5, ['Almond butter' => 2, 'Banana' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Omelet', 'breakfast', 'Make omelet with bell peppers and spinach.', 15, ['Eggs' => 3, 'Bell pepper' => 0.5, 'Spinach' => 1, 'Olive oil' => 1]);

        // Lunches (14)
        $this->createRecipe($diet, 'Grilled Chicken Salad', 'lunch', 'Top mixed greens with grilled chicken and olive oil.', 25, ['Chicken breast' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Salmon and Rice Bowl', 'lunch', 'Serve grilled salmon over rice with vegetables.', 30, ['Salmon fillet' => 6, 'Brown rice' => 1, 'Cucumber' => 0.5, 'Carrots' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Turkey Lettuce Wraps', 'lunch', 'Fill lettuce cups with seasoned ground turkey.', 20, ['Ground turkey' => 6, 'Romaine lettuce' => 0.5, 'Carrots' => 1, 'Ginger' => 0.5]);
        $this->createRecipe($diet, 'Quinoa Salad', 'lunch', 'Toss quinoa with cucumber, tomatoes, and olive oil.', 20, ['Quinoa' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Fresh parsley' => 1, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Chicken and Rice Soup', 'lunch', 'Simmer chicken with rice, carrots, and celery.', 40, ['Chicken breast' => 4, 'Brown rice' => 0.5, 'Carrots' => 2, 'Celery' => 2, 'Chicken broth' => 2]);
        $this->createRecipe($diet, 'Tuna Salad', 'lunch', 'Mix tuna with olive oil and serve over greens.', 15, ['Tuna' => 5, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Stir-Fry', 'lunch', 'Stir-fry low-FODMAP vegetables with chicken.', 25, ['Chicken breast' => 4, 'Bell pepper' => 1, 'Carrots' => 1, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Egg Salad', 'lunch', 'Serve egg salad over mixed greens.', 15, ['Eggs' => 4, 'Mixed greens' => 2, 'Dijon mustard' => 0.5, 'Fresh dill' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Chicken and Potato', 'lunch', 'Serve grilled chicken with baked potato.', 35, ['Chicken breast' => 6, 'Sweet potato' => 1, 'Olive oil' => 1, 'Fresh rosemary' => 1]);
        $this->createRecipe($diet, 'Shrimp Salad', 'lunch', 'Top mixed greens with grilled shrimp.', 20, ['Shrimp' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Rice Noodle Bowl', 'lunch', 'Toss rice noodles with vegetables and chicken.', 25, ['Rice noodles' => 1, 'Chicken breast' => 4, 'Carrots' => 1, 'Soy sauce' => 1]);
        $this->createRecipe($diet, 'Zucchini Noodles', 'lunch', 'Spiralize zucchini and toss with olive oil and chicken.', 20, ['Zucchini' => 2, 'Chicken breast' => 4, 'Olive oil' => 2, 'Fresh basil' => 1]);
        $this->createRecipe($diet, 'Beef and Rice', 'lunch', 'Serve grilled beef over rice with vegetables.', 25, ['Ground beef' => 6, 'Brown rice' => 1, 'Carrots' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Salmon Salad', 'lunch', 'Top greens with salmon and olive oil.', 20, ['Salmon fillet' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Olive oil' => 2]);

        // Dinners (14)
        $this->createRecipe($diet, 'Grilled Chicken', 'dinner', 'Grill chicken and serve with rice and vegetables.', 30, ['Chicken breast' => 6, 'Brown rice' => 1, 'Carrots' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Baked Salmon', 'dinner', 'Bake salmon with lemon and dill.', 25, ['Salmon fillet' => 6, 'Lemon' => 0.5, 'Fresh dill' => 1, 'Olive oil' => 2, 'Quinoa' => 1]);
        $this->createRecipe($diet, 'Beef Stir-Fry', 'dinner', 'Stir-fry beef with low-FODMAP vegetables.', 25, ['Ground beef' => 6, 'Bell pepper' => 1, 'Carrots' => 1, 'Soy sauce' => 1, 'Ginger' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Roasted Chicken', 'dinner', 'Roast chicken with herbs and potatoes.', 60, ['Chicken breast' => 8, 'Sweet potato' => 1, 'Fresh rosemary' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Shrimp and Rice', 'dinner', 'Sauté shrimp with vegetables and serve over rice.', 20, ['Shrimp' => 8, 'Bell pepper' => 1, 'Carrots' => 1, 'Brown rice' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Pork Tenderloin', 'dinner', 'Roast pork with herbs and vegetables.', 40, ['Pork tenderloin' => 6, 'Carrots' => 2, 'Fresh rosemary' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Turkey Meatballs', 'dinner', 'Bake turkey meatballs and serve with zucchini.', 35, ['Ground turkey' => 6, 'Eggs' => 1, 'Zucchini' => 1, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Baked Cod', 'dinner', 'Bake cod with tomatoes and herbs.', 25, ['Cod' => 6, 'Cherry tomatoes' => 0.5, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Grilled Steak', 'dinner', 'Grill steak and serve with potatoes.', 30, ['Ground beef' => 8, 'Sweet potato' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Chicken and Quinoa', 'dinner', 'Serve grilled chicken over quinoa with vegetables.', 30, ['Chicken breast' => 6, 'Quinoa' => 1, 'Bell pepper' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Salmon with Vegetables', 'dinner', 'Bake salmon with zucchini and carrots.', 30, ['Salmon fillet' => 6, 'Zucchini' => 1, 'Carrots' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Pork Stir-Fry', 'dinner', 'Stir-fry pork with vegetables.', 25, ['Pork tenderloin' => 6, 'Bell pepper' => 1, 'Carrots' => 1, 'Soy sauce' => 1, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Turkey and Rice', 'dinner', 'Serve roasted turkey with rice.', 40, ['Ground turkey' => 6, 'Brown rice' => 1, 'Carrots' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Grilled Fish', 'dinner', 'Grill fish with lemon and herbs.', 25, ['Cod' => 6, 'Lemon' => 0.5, 'Fresh dill' => 1, 'Olive oil' => 2, 'Quinoa' => 1]);
    }

    private function seedDiabeticFriendly(): void
    {
        $diet = Diet::where('slug', 'diabetic-friendly')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Vegetable Egg Scramble', 'breakfast', 'Scramble eggs with spinach, mushrooms, and bell peppers.', 15, ['Eggs' => 2, 'Spinach' => 2, 'Mushrooms' => 4, 'Bell pepper' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Greek Yogurt with Nuts', 'breakfast', 'Top plain Greek yogurt with walnuts and a few berries.', 5, ['Greek yogurt' => 1, 'Walnuts' => 0.25, 'Blueberries' => 0.25]);
        $this->createRecipe($diet, 'Avocado and Egg', 'breakfast', 'Serve mashed avocado with poached eggs.', 15, ['Avocado' => 0.5, 'Eggs' => 2, 'Sea salt' => 0.25]);
        $this->createRecipe($diet, 'Cottage Cheese with Vegetables', 'breakfast', 'Top cottage cheese with cucumber and tomatoes.', 5, ['Cottage cheese' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Omelet', 'breakfast', 'Make fluffy omelet filled with vegetables.', 15, ['Eggs' => 3, 'Bell pepper' => 0.5, 'Mushrooms' => 4, 'Spinach' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Smoked Salmon Plate', 'breakfast', 'Serve smoked salmon with cucumber and cream cheese.', 10, ['Salmon fillet' => 4, 'Cucumber' => 0.5, 'Cream cheese' => 1]);
        $this->createRecipe($diet, 'Chia Pudding', 'breakfast', 'Soak chia seeds in unsweetened almond milk.', 5, ['Chia seeds' => 2, 'Almond milk' => 1, 'Walnuts' => 0.25]);
        $this->createRecipe($diet, 'Bacon and Eggs', 'breakfast', 'Fry turkey bacon and eggs. Serve with avocado.', 15, ['Bacon' => 3, 'Eggs' => 2, 'Avocado' => 0.5]);
        $this->createRecipe($diet, 'Egg Muffins', 'breakfast', 'Bake eggs with vegetables in muffin tins.', 30, ['Eggs' => 4, 'Bell pepper' => 0.5, 'Spinach' => 1, 'Onion' => 0.25]);
        $this->createRecipe($diet, 'Tofu Scramble', 'breakfast', 'Scramble tofu with turmeric and vegetables.', 15, ['Tofu' => 6, 'Turmeric' => 0.5, 'Bell pepper' => 0.5, 'Spinach' => 2, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Green Smoothie', 'breakfast', 'Blend spinach, cucumber, and almond milk.', 5, ['Spinach' => 2, 'Cucumber' => 0.5, 'Almond milk' => 1]);
        $this->createRecipe($diet, 'Hard Boiled Eggs', 'breakfast', 'Serve hard boiled eggs with vegetables.', 15, ['Eggs' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5]);
        $this->createRecipe($diet, 'Almond Flour Pancakes', 'breakfast', 'Make low-carb pancakes with almond flour.', 20, ['Eggs' => 2, 'Almond flour' => 0.25, 'Cream cheese' => 1]);
        $this->createRecipe($diet, 'Spinach and Feta Frittata', 'breakfast', 'Bake eggs with spinach and feta cheese.', 25, ['Eggs' => 4, 'Spinach' => 3, 'Feta cheese' => 0.25, 'Olive oil' => 1]);

        // Lunches (14)
        $this->createRecipe($diet, 'Grilled Chicken Salad', 'lunch', 'Top mixed greens with grilled chicken and olive oil.', 25, ['Chicken breast' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Turkey Lettuce Wraps', 'lunch', 'Fill lettuce cups with seasoned ground turkey.', 20, ['Ground turkey' => 6, 'Romaine lettuce' => 0.5, 'Bell pepper' => 0.5, 'Onion' => 0.25]);
        $this->createRecipe($diet, 'Salmon and Vegetables', 'lunch', 'Serve grilled salmon with roasted vegetables.', 30, ['Salmon fillet' => 6, 'Broccoli' => 0.5, 'Zucchini' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Tuna Salad', 'lunch', 'Mix tuna with olive oil and serve over greens.', 15, ['Tuna' => 5, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Cauliflower Rice Bowl', 'lunch', 'Top cauliflower rice with grilled chicken.', 25, ['Cauliflower' => 0.5, 'Chicken breast' => 4, 'Bell pepper' => 0.5, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Egg Salad Cups', 'lunch', 'Serve egg salad in lettuce cups.', 15, ['Eggs' => 4, 'Romaine lettuce' => 0.5, 'Dijon mustard' => 0.5]);
        $this->createRecipe($diet, 'Chicken and Vegetable Soup', 'lunch', 'Simmer chicken with low-carb vegetables.', 40, ['Chicken breast' => 4, 'Celery' => 2, 'Spinach' => 2, 'Chicken broth' => 2]);
        $this->createRecipe($diet, 'Greek Salad', 'lunch', 'Toss cucumber, tomatoes, and feta with olive oil.', 15, ['Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Feta cheese' => 0.25, 'Olives' => 0.25, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Shrimp Salad', 'lunch', 'Top mixed greens with grilled shrimp.', 20, ['Shrimp' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Zucchini Noodles', 'lunch', 'Spiralize zucchini and top with grilled chicken.', 20, ['Zucchini' => 2, 'Chicken breast' => 4, 'Olive oil' => 2, 'Fresh basil' => 1]);
        $this->createRecipe($diet, 'Beef and Broccoli', 'lunch', 'Stir-fry beef with broccoli in low-sodium sauce.', 25, ['Ground beef' => 6, 'Broccoli' => 0.5, 'Soy sauce' => 0.5, 'Ginger' => 0.5]);
        $this->createRecipe($diet, 'Caprese Salad', 'lunch', 'Layer mozzarella with tomatoes and basil.', 10, ['Mozzarella cheese' => 0.5, 'Tomatoes' => 2, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Stuffed Avocado', 'lunch', 'Fill avocado with chicken salad.', 15, ['Avocado' => 1, 'Chicken breast' => 4, 'Fresh cilantro' => 1, 'Lime' => 0.5]);
        $this->createRecipe($diet, 'Cucumber Tuna Boats', 'lunch', 'Fill cucumber halves with tuna salad.', 15, ['Tuna' => 5, 'Cucumber' => 2, 'Olive oil' => 1, 'Fresh dill' => 1]);

        // Dinners (14)
        $this->createRecipe($diet, 'Grilled Salmon', 'dinner', 'Grill salmon with herbs and serve with vegetables.', 25, ['Salmon fillet' => 6, 'Asparagus' => 0.5, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Chicken Stir-Fry', 'dinner', 'Stir-fry chicken with low-carb vegetables.', 25, ['Chicken breast' => 6, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Soy sauce' => 0.5, 'Ginger' => 0.5]);
        $this->createRecipe($diet, 'Baked Cod', 'dinner', 'Bake cod with tomatoes and herbs.', 25, ['Cod' => 6, 'Cherry tomatoes' => 0.5, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Turkey Meatballs', 'dinner', 'Bake turkey meatballs and serve with zucchini.', 35, ['Ground turkey' => 6, 'Eggs' => 1, 'Zucchini' => 1, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Grilled Steak', 'dinner', 'Grill steak and serve with roasted vegetables.', 30, ['Ground beef' => 6, 'Asparagus' => 0.5, 'Bell pepper' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Shrimp and Vegetables', 'dinner', 'Sauté shrimp with zucchini and bell peppers.', 20, ['Shrimp' => 8, 'Zucchini' => 1, 'Bell pepper' => 1, 'Olive oil' => 2, 'Garlic' => 2]);
        $this->createRecipe($diet, 'Pork Tenderloin', 'dinner', 'Roast pork with herbs and serve with vegetables.', 40, ['Pork tenderloin' => 6, 'Broccoli' => 0.5, 'Fresh rosemary' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Chicken with Vegetables', 'dinner', 'Roast chicken with zucchini and peppers.', 40, ['Chicken breast' => 6, 'Zucchini' => 1, 'Bell pepper' => 1, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Cauliflower Crust Pizza', 'dinner', 'Make pizza with cauliflower crust and vegetables.', 40, ['Cauliflower' => 0.5, 'Eggs' => 1, 'Mozzarella cheese' => 0.5, 'Diced tomatoes (canned)' => 0.5, 'Bell pepper' => 0.5]);
        $this->createRecipe($diet, 'Stuffed Peppers', 'dinner', 'Fill peppers with ground turkey and vegetables.', 45, ['Bell pepper' => 2, 'Ground turkey' => 6, 'Diced tomatoes (canned)' => 0.5, 'Cauliflower' => 0.25]);
        $this->createRecipe($diet, 'Salmon with Broccoli', 'dinner', 'Bake salmon with roasted broccoli.', 25, ['Salmon fillet' => 6, 'Broccoli' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Beef and Vegetable Kebabs', 'dinner', 'Grill beef and vegetable skewers.', 30, ['Ground beef' => 6, 'Bell pepper' => 1, 'Zucchini' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Chicken Curry', 'dinner', 'Simmer chicken in coconut curry sauce with cauliflower.', 35, ['Chicken breast' => 6, 'Coconut milk' => 0.5, 'Cauliflower' => 0.5, 'Turmeric' => 0.5, 'Cumin' => 0.5]);
        $this->createRecipe($diet, 'Zucchini Lasagna', 'dinner', 'Layer zucchini with meat and cheese.', 50, ['Zucchini' => 2, 'Ground beef' => 6, 'Ricotta cheese' => 0.5, 'Mozzarella cheese' => 0.5, 'Diced tomatoes (canned)' => 0.5]);
    }

    private function seedPescatarian(): void
    {
        $diet = Diet::where('slug', 'pescatarian')->first();

        // Breakfasts (14)
        $this->createRecipe($diet, 'Smoked Salmon Bagel', 'breakfast', 'Top bagel with cream cheese and smoked salmon.', 10, ['Whole wheat bread' => 2, 'Salmon fillet' => 4, 'Cream cheese' => 2, 'Capers' => 1]);
        $this->createRecipe($diet, 'Greek Yogurt Parfait', 'breakfast', 'Layer Greek yogurt with berries and granola.', 5, ['Greek yogurt' => 1, 'Blueberries' => 0.5, 'Strawberries' => 0.5, 'Honey' => 1]);
        $this->createRecipe($diet, 'Vegetable Scramble', 'breakfast', 'Scramble eggs with spinach, tomatoes, and mushrooms.', 15, ['Eggs' => 3, 'Spinach' => 2, 'Cherry tomatoes' => 0.5, 'Mushrooms' => 4, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Avocado Toast with Egg', 'breakfast', 'Top toast with avocado and a fried egg.', 15, ['Whole wheat bread' => 2, 'Avocado' => 0.5, 'Eggs' => 1, 'Sea salt' => 0.25]);
        $this->createRecipe($diet, 'Oatmeal with Fruit', 'breakfast', 'Cook oats and top with fresh berries and walnuts.', 10, ['Oats' => 0.5, 'Milk' => 1, 'Blueberries' => 0.5, 'Walnuts' => 0.25]);
        $this->createRecipe($diet, 'Tuna Salad Toast', 'breakfast', 'Top toast with seasoned tuna salad.', 15, ['Whole wheat bread' => 2, 'Tuna' => 5, 'Olive oil' => 1, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Chia Pudding', 'breakfast', 'Soak chia seeds in milk. Top with fruit.', 5, ['Chia seeds' => 2, 'Almond milk' => 1, 'Strawberries' => 0.5, 'Honey' => 1]);
        $this->createRecipe($diet, 'Cottage Cheese Bowl', 'breakfast', 'Top cottage cheese with fruit and nuts.', 5, ['Cottage cheese' => 1, 'Blueberries' => 0.5, 'Almonds' => 0.25]);
        $this->createRecipe($diet, 'Veggie Omelet', 'breakfast', 'Make omelet filled with vegetables and cheese.', 15, ['Eggs' => 3, 'Bell pepper' => 0.5, 'Spinach' => 1, 'Feta cheese' => 0.25, 'Olive oil' => 1]);
        $this->createRecipe($diet, 'Banana Smoothie', 'breakfast', 'Blend banana with Greek yogurt and almond milk.', 5, ['Banana' => 1, 'Greek yogurt' => 0.5, 'Almond milk' => 0.5]);
        $this->createRecipe($diet, 'Whole Grain Pancakes', 'breakfast', 'Make pancakes with whole wheat flour. Serve with fruit.', 20, ['Whole wheat bread' => 2, 'Eggs' => 1, 'Milk' => 0.5, 'Maple syrup' => 1, 'Blueberries' => 0.5]);
        $this->createRecipe($diet, 'Shakshuka', 'breakfast', 'Poach eggs in spiced tomato sauce.', 25, ['Eggs' => 2, 'Diced tomatoes (canned)' => 1, 'Bell pepper' => 0.5, 'Onion' => 0.5, 'Cumin' => 0.5]);
        $this->createRecipe($diet, 'Sardine Toast', 'breakfast', 'Top toast with sardines, lemon, and herbs.', 10, ['Whole wheat bread' => 2, 'Tuna' => 5, 'Lemon' => 0.5, 'Fresh parsley' => 1]);
        $this->createRecipe($diet, 'Fruit and Nut Bowl', 'breakfast', 'Combine fresh fruit with mixed nuts.', 5, ['Banana' => 0.5, 'Blueberries' => 0.5, 'Almonds' => 0.25, 'Walnuts' => 0.25]);

        // Lunches (14)
        $this->createRecipe($diet, 'Salmon Salad', 'lunch', 'Top mixed greens with grilled salmon and olive oil.', 25, ['Salmon fillet' => 6, 'Mixed greens' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Tuna Nicoise', 'lunch', 'Arrange tuna over greens with eggs and olives.', 20, ['Tuna' => 5, 'Mixed greens' => 3, 'Eggs' => 2, 'Olives' => 0.25, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Shrimp Wrap', 'lunch', 'Fill wrap with grilled shrimp and vegetables.', 20, ['Shrimp' => 6, 'Whole wheat bread' => 2, 'Mixed greens' => 2, 'Avocado' => 0.5]);
        $this->createRecipe($diet, 'Fish Tacos', 'lunch', 'Fill tortillas with grilled fish and slaw.', 25, ['Cod' => 6, 'Fresh cilantro' => 1, 'Lime' => 0.5, 'Sour cream' => 2]);
        $this->createRecipe($diet, 'Mediterranean Plate', 'lunch', 'Arrange hummus, vegetables, and sardines.', 15, ['Hummus' => 0.5, 'Tuna' => 3, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Whole wheat bread' => 2]);
        $this->createRecipe($diet, 'Quinoa and Salmon Bowl', 'lunch', 'Top quinoa with grilled salmon and vegetables.', 30, ['Quinoa' => 1, 'Salmon fillet' => 6, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Shrimp Salad', 'lunch', 'Toss grilled shrimp with mixed greens.', 20, ['Shrimp' => 6, 'Mixed greens' => 3, 'Avocado' => 0.5, 'Lime' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Vegetable Soup', 'lunch', 'Simmer vegetables in broth with herbs.', 40, ['Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Vegetable broth' => 2, 'Fresh thyme' => 1]);
        $this->createRecipe($diet, 'Caprese Salad', 'lunch', 'Layer mozzarella with tomatoes and basil.', 10, ['Mozzarella cheese' => 0.5, 'Tomatoes' => 2, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Tuna Stuffed Avocado', 'lunch', 'Fill avocado halves with tuna salad.', 15, ['Tuna' => 5, 'Avocado' => 1, 'Olive oil' => 1, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Greek Salad with Shrimp', 'lunch', 'Top Greek salad with grilled shrimp.', 20, ['Shrimp' => 6, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Feta cheese' => 0.25, 'Olives' => 0.25, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Egg Salad Sandwich', 'lunch', 'Serve egg salad on whole grain bread.', 15, ['Eggs' => 4, 'Whole wheat bread' => 2, 'Dijon mustard' => 0.5, 'Fresh dill' => 1]);
        $this->createRecipe($diet, 'Lentil Soup', 'lunch', 'Simmer lentils with vegetables.', 40, ['Lentils' => 1, 'Carrots' => 2, 'Celery' => 2, 'Onion' => 0.5, 'Vegetable broth' => 2]);
        $this->createRecipe($diet, 'Salmon Rice Bowl', 'lunch', 'Top rice with salmon, avocado, and cucumber.', 30, ['Salmon fillet' => 6, 'Brown rice' => 1, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Soy sauce' => 1]);

        // Dinners (14)
        $this->createRecipe($diet, 'Grilled Salmon', 'dinner', 'Grill salmon with herbs and serve with quinoa.', 25, ['Salmon fillet' => 6, 'Quinoa' => 1, 'Asparagus' => 0.5, 'Lemon' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Shrimp Stir-Fry', 'dinner', 'Stir-fry shrimp with vegetables and serve over rice.', 25, ['Shrimp' => 8, 'Broccoli' => 0.5, 'Bell pepper' => 1, 'Soy sauce' => 1, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Baked Cod', 'dinner', 'Bake cod with tomatoes, olives, and herbs.', 25, ['Cod' => 6, 'Cherry tomatoes' => 1, 'Olives' => 0.25, 'Fresh basil' => 1, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Seafood Paella', 'dinner', 'Cook rice with shrimp, fish, and vegetables.', 45, ['Brown rice' => 1, 'Shrimp' => 4, 'Cod' => 4, 'Bell pepper' => 1, 'Turmeric' => 0.5]);
        $this->createRecipe($diet, 'Tuna Steak', 'dinner', 'Sear tuna steak and serve with vegetables.', 20, ['Tuna' => 8, 'Asparagus' => 0.5, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Curry', 'dinner', 'Simmer vegetables in coconut curry sauce.', 35, ['Cauliflower' => 0.25, 'Chickpeas' => 0.5, 'Coconut milk' => 1, 'Turmeric' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Shrimp with Pasta', 'dinner', 'Toss shrimp with whole wheat pasta and vegetables.', 25, ['Shrimp' => 8, 'Whole wheat pasta' => 1, 'Cherry tomatoes' => 0.5, 'Garlic' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Fish Curry', 'dinner', 'Simmer fish in coconut curry sauce.', 30, ['Cod' => 6, 'Coconut milk' => 1, 'Diced tomatoes (canned)' => 0.5, 'Turmeric' => 0.5, 'Brown rice' => 1]);
        $this->createRecipe($diet, 'Stuffed Bell Peppers', 'dinner', 'Fill peppers with rice, vegetables, and cheese.', 45, ['Bell pepper' => 2, 'Brown rice' => 1, 'Diced tomatoes (canned)' => 0.5, 'Mozzarella cheese' => 0.5]);
        $this->createRecipe($diet, 'Salmon with Vegetables', 'dinner', 'Roast salmon with zucchini and tomatoes.', 30, ['Salmon fillet' => 6, 'Zucchini' => 1, 'Cherry tomatoes' => 0.5, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Mussels in White Wine', 'dinner', 'Steam mussels with garlic and herbs. Serve with bread.', 25, ['Shrimp' => 8, 'Garlic' => 3, 'Fresh parsley' => 1, 'Whole wheat bread' => 2, 'Olive oil' => 2]);
        $this->createRecipe($diet, 'Eggplant Parmesan', 'dinner', 'Bake breaded eggplant with marinara and cheese.', 45, ['Eggplant' => 1, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.5, 'Parmesan cheese' => 2]);
        $this->createRecipe($diet, 'Grilled Shrimp Skewers', 'dinner', 'Grill shrimp and vegetable skewers.', 25, ['Shrimp' => 8, 'Zucchini' => 1, 'Bell pepper' => 1, 'Olive oil' => 2, 'Lemon' => 0.5]);
        $this->createRecipe($diet, 'Vegetable Lasagna', 'dinner', 'Layer pasta with ricotta, spinach, and vegetables.', 60, ['Whole wheat pasta' => 1, 'Ricotta cheese' => 1, 'Spinach' => 3, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.5]);
    }

    private function createRecipe(Diet $diet, string $name, string $mealType, string $instructions, int $prepTime, array $ingredients): void
    {
        $recipe = Recipe::create([
            'diet_id' => $diet->id,
            'name' => $name,
            'meal_type' => $mealType,
            'instructions' => $instructions,
            'prep_time' => $prepTime,
        ]);

        foreach ($ingredients as $ingredientName => $quantity) {
            if (isset($this->ingredientCache[$ingredientName])) {
                $recipe->ingredients()->attach($this->ingredientCache[$ingredientName], [
                    'quantity' => $quantity,
                ]);
            }
        }
    }
}
