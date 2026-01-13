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
            ['Eggs' => 2, 'Spinach' => 1, 'Cherry tomatoes' => 0.5, 'Feta cheese' => 0.25, 'Olive oil' => 1, 'Dried oregano' => 0.5]);

        $this->createRecipe($diet, 'Avocado Toast with Tomatoes', 'breakfast',
            'Toast whole grain bread and top with mashed avocado, sliced tomatoes, olive oil, and a sprinkle of sea salt.', 10,
            ['Whole wheat bread' => 2, 'Avocado' => 0.5, 'Tomatoes' => 0.5, 'Olive oil' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Oatmeal with Figs and Almonds', 'breakfast',
            'Cook oats and top with sliced almonds, a drizzle of honey, and cinnamon.', 10,
            ['Oats' => 0.5, 'Almonds' => 0.25, 'Honey' => 1, 'Cinnamon' => 0.5, 'Milk' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Greek Salad with Grilled Chicken', 'lunch',
            'Combine romaine, cucumbers, tomatoes, red onion, olives, and feta. Top with grilled chicken and olive oil dressing.', 20,
            ['Romaine lettuce' => 2, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Red onion' => 0.25, 'Olives' => 0.25, 'Feta cheese' => 0.25, 'Chicken breast' => 1, 'Olive oil' => 2, 'Lemon juice' => 1]);

        $this->createRecipe($diet, 'Hummus and Veggie Wrap', 'lunch',
            'Spread hummus on whole wheat wrap, add mixed greens, cucumber, tomatoes, and feta. Roll and enjoy.', 10,
            ['Hummus' => 0.5, 'Whole wheat bread' => 2, 'Mixed greens' => 1, 'Cucumber' => 0.5, 'Tomatoes' => 0.5, 'Feta cheese' => 0.25]);

        $this->createRecipe($diet, 'Lentil Soup', 'lunch',
            'Simmer lentils with diced tomatoes, carrots, celery, onion, and garlic. Season with cumin and serve with crusty bread.', 35,
            ['Lentils' => 1, 'Diced tomatoes (canned)' => 1, 'Carrots' => 0.5, 'Celery' => 0.5, 'Onion' => 0.5, 'Garlic' => 1, 'Cumin' => 1, 'Olive oil' => 1, 'Vegetable broth' => 2]);

        $this->createRecipe($diet, 'Tuna Salad Lettuce Wraps', 'lunch',
            'Mix tuna with olive oil, lemon juice, capers, and fresh herbs. Serve in crisp lettuce cups.', 15,
            ['Tuna' => 1, 'Olive oil' => 2, 'Lemon juice' => 1, 'Capers' => 1, 'Fresh parsley' => 1, 'Romaine lettuce' => 2]);

        // Dinners
        $this->createRecipe($diet, 'Grilled Salmon with Vegetables', 'dinner',
            'Grill salmon with olive oil and lemon. Serve with roasted zucchini, bell peppers, and cherry tomatoes.', 30,
            ['Salmon fillet' => 1, 'Olive oil' => 2, 'Lemon juice' => 2, 'Zucchini' => 1, 'Bell pepper' => 1, 'Cherry tomatoes' => 0.5, 'Fresh thyme' => 1, 'Sea salt' => 0.5]);

        $this->createRecipe($diet, 'Chicken Souvlaki Bowl', 'dinner',
            'Marinate chicken in olive oil, lemon, and oregano. Grill and serve over quinoa with cucumber, tomatoes, and tzatziki.', 35,
            ['Chicken breast' => 1, 'Quinoa' => 1, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Greek yogurt' => 0.5, 'Olive oil' => 2, 'Lemon juice' => 1, 'Dried oregano' => 1, 'Garlic' => 1]);

        $this->createRecipe($diet, 'Shrimp with White Beans and Spinach', 'dinner',
            'Sauté shrimp with garlic, add white beans and spinach. Finish with lemon and fresh parsley.', 20,
            ['Shrimp' => 1, 'White beans' => 1, 'Spinach' => 2, 'Garlic' => 1, 'Olive oil' => 2, 'Lemon juice' => 1, 'Fresh parsley' => 1, 'Red pepper flakes' => 0.5]);

        $this->createRecipe($diet, 'Baked Cod with Tomatoes and Olives', 'dinner',
            'Bake cod with cherry tomatoes, olives, capers, and fresh herbs. Serve with a side of farro.', 25,
            ['Cod' => 1, 'Cherry tomatoes' => 1, 'Olives' => 0.25, 'Capers' => 1, 'Fresh basil' => 1, 'Olive oil' => 2, 'Farro' => 1]);
    }

    private function seedVegetarian(): void
    {
        $diet = Diet::where('slug', 'vegetarian')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Veggie Scramble', 'breakfast',
            'Scramble eggs with bell peppers, onions, spinach, and mushrooms. Top with shredded cheese.', 15,
            ['Eggs' => 2, 'Bell pepper' => 0.5, 'Onion' => 0.25, 'Spinach' => 1, 'Mushrooms' => 0.5, 'Cheddar cheese' => 0.25, 'Olive oil' => 1]);

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
            ['Quinoa' => 1, 'Chickpeas' => 0.5, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Mixed greens' => 2, 'Tahini' => 2, 'Lemon juice' => 1]);

        $this->createRecipe($diet, 'Caprese Salad with Quinoa', 'lunch',
            'Layer fresh mozzarella, tomatoes, and basil over quinoa. Drizzle with balsamic and olive oil.', 15,
            ['Mozzarella cheese' => 0.5, 'Tomatoes' => 1, 'Fresh basil' => 2, 'Quinoa' => 1, 'Balsamic vinegar' => 1, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Black Bean Tacos', 'lunch',
            'Fill corn tortillas with seasoned black beans, avocado, salsa, and fresh cilantro.', 20,
            ['Black beans' => 1, 'Avocado' => 0.5, 'Tomatoes' => 0.5, 'Fresh cilantro' => 1, 'Lime juice' => 1, 'Cumin' => 0.5, 'Sour cream' => 2]);

        $this->createRecipe($diet, 'Vegetable Stir-Fry', 'lunch',
            'Stir-fry tofu with broccoli, bell peppers, and snap peas in soy sauce. Serve over rice.', 25,
            ['Tofu' => 1, 'Broccoli' => 1, 'Bell pepper' => 0.5, 'Soy sauce' => 2, 'Brown rice' => 1, 'Garlic' => 1, 'Ginger' => 0.5]);

        // Dinners
        $this->createRecipe($diet, 'Eggplant Parmesan', 'dinner',
            'Bread and bake eggplant slices, layer with marinara and mozzarella. Bake until bubbly.', 45,
            ['Eggplant' => 2, 'Diced tomatoes (canned)' => 1, 'Mozzarella cheese' => 0.5, 'Parmesan cheese' => 2, 'Fresh basil' => 1, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Stuffed Bell Peppers', 'dinner',
            'Fill bell peppers with quinoa, black beans, corn, and cheese. Bake until tender.', 40,
            ['Bell pepper' => 2, 'Quinoa' => 1, 'Black beans' => 0.5, 'Tomatoes' => 0.5, 'Cheddar cheese' => 0.5, 'Cumin' => 0.5]);

        $this->createRecipe($diet, 'Mushroom Risotto', 'dinner',
            'Cook arborio rice slowly with vegetable broth, sautéed mushrooms, and parmesan. Finish with butter.', 40,
            ['Brown rice' => 1, 'Mushrooms' => 2, 'Vegetable broth' => 3, 'Parmesan cheese' => 2, 'Butter' => 2, 'Onion' => 0.25, 'Garlic' => 1]);

        $this->createRecipe($diet, 'Lentil Curry', 'dinner',
            'Simmer lentils in coconut milk with curry spices, tomatoes, and spinach. Serve over rice.', 35,
            ['Lentils' => 1, 'Coconut milk' => 1, 'Diced tomatoes (canned)' => 1, 'Spinach' => 2, 'Turmeric' => 0.5, 'Cumin' => 0.5, 'Ginger' => 0.5, 'Brown rice' => 1]);
    }

    private function seedKeto(): void
    {
        $diet = Diet::where('slug', 'keto')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Bacon and Eggs', 'breakfast',
            'Fry bacon until crispy. Cook eggs in the bacon fat. Serve with sliced avocado.', 15,
            ['Bacon' => 0.5, 'Eggs' => 3, 'Avocado' => 0.5, 'Sea salt' => 0.25, 'Black pepper' => 0.25]);

        $this->createRecipe($diet, 'Keto Egg Muffins', 'breakfast',
            'Mix eggs with cheese, spinach, and bacon. Pour into muffin tins and bake until set.', 30,
            ['Eggs' => 4, 'Cheddar cheese' => 0.5, 'Spinach' => 1, 'Bacon' => 0.25, 'Heavy cream' => 0.25]);

        $this->createRecipe($diet, 'Cream Cheese Pancakes', 'breakfast',
            'Blend cream cheese, eggs, and almond flour. Cook as thin pancakes. Serve with butter.', 20,
            ['Cream cheese' => 4, 'Eggs' => 2, 'Almond flour' => 0.25, 'Butter' => 2, 'Cinnamon' => 0.5]);

        $this->createRecipe($diet, 'Smoked Salmon Plate', 'breakfast',
            'Arrange smoked salmon with cream cheese, capers, and sliced cucumber.', 10,
            ['Salmon fillet' => 1, 'Cream cheese' => 2, 'Capers' => 1, 'Cucumber' => 0.5, 'Fresh dill' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Cobb Salad', 'lunch',
            'Top mixed greens with grilled chicken, bacon, eggs, avocado, blue cheese, and ranch dressing.', 20,
            ['Mixed greens' => 3, 'Chicken breast' => 1, 'Bacon' => 0.25, 'Eggs' => 2, 'Avocado' => 0.5, 'Goat cheese' => 0.25, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Tuna Stuffed Avocados', 'lunch',
            'Mix tuna with mayo and celery. Stuff into avocado halves. Season with lemon.', 15,
            ['Tuna' => 1, 'Avocado' => 1, 'Celery' => 0.25, 'Lemon juice' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Burger Lettuce Wraps', 'lunch',
            'Grill beef patties, wrap in large lettuce leaves with cheese, tomato, and mustard.', 20,
            ['Ground beef' => 1, 'Romaine lettuce' => 2, 'Cheddar cheese' => 0.25, 'Tomatoes' => 0.5, 'Dijon mustard' => 1]);

        $this->createRecipe($diet, 'Chicken Caesar Salad (No Croutons)', 'lunch',
            'Toss romaine with grilled chicken, parmesan, and creamy caesar dressing.', 15,
            ['Romaine lettuce' => 3, 'Chicken breast' => 1, 'Parmesan cheese' => 2, 'Olive oil' => 2, 'Lemon juice' => 1, 'Garlic' => 0.5]);

        // Dinners
        $this->createRecipe($diet, 'Steak with Garlic Butter Asparagus', 'dinner',
            'Pan-sear steak to desired doneness. Sauté asparagus in garlic butter. Serve together.', 25,
            ['Ground beef' => 1.5, 'Asparagus' => 2, 'Butter' => 3, 'Garlic' => 1, 'Fresh rosemary' => 1, 'Sea salt' => 0.5]);

        $this->createRecipe($diet, 'Creamy Tuscan Chicken', 'dinner',
            'Pan-fry chicken, make cream sauce with sun-dried tomatoes, spinach, and parmesan.', 30,
            ['Chicken breast' => 1, 'Heavy cream' => 0.5, 'Sun-dried tomatoes' => 0.25, 'Spinach' => 2, 'Parmesan cheese' => 2, 'Garlic' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Baked Salmon with Broccoli', 'dinner',
            'Bake salmon with lemon and dill. Roast broccoli with olive oil and garlic.', 25,
            ['Salmon fillet' => 1, 'Broccoli' => 2, 'Olive oil' => 2, 'Lemon juice' => 1, 'Fresh dill' => 1, 'Garlic' => 1]);

        $this->createRecipe($diet, 'Pork Chops with Cauliflower Mash', 'dinner',
            'Pan-sear pork chops. Make creamy cauliflower mash with butter and cream.', 30,
            ['Pork tenderloin' => 1, 'Cauliflower' => 3, 'Butter' => 2, 'Heavy cream' => 0.25, 'Garlic' => 0.5, 'Fresh thyme' => 1]);
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
            ['Eggs' => 3, 'Spinach' => 1, 'Tomatoes' => 0.5, 'Mushrooms' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Whole Grain Toast with Banana', 'breakfast',
            'Toast whole grain bread, spread with almond butter, and top with sliced banana.', 10,
            ['Whole wheat bread' => 2, 'Almond butter' => 2, 'Banana' => 0.5]);

        $this->createRecipe($diet, 'Greek Yogurt with Fruit', 'breakfast',
            'Top low-fat Greek yogurt with mixed berries and a sprinkle of flax seeds.', 5,
            ['Greek yogurt' => 1, 'Strawberries' => 0.5, 'Blueberries' => 0.25, 'Flax seeds' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Turkey and Veggie Wrap', 'lunch',
            'Wrap sliced turkey breast with lettuce, tomato, cucumber in whole wheat tortilla.', 10,
            ['Ground turkey' => 0.75, 'Whole wheat bread' => 2, 'Romaine lettuce' => 1, 'Tomatoes' => 0.5, 'Cucumber' => 0.5, 'Dijon mustard' => 1]);

        $this->createRecipe($diet, 'Chicken and Vegetable Soup', 'lunch',
            'Simmer chicken breast with carrots, celery, onion in low-sodium broth. Add herbs.', 40,
            ['Chicken breast' => 0.75, 'Carrots' => 0.5, 'Celery' => 0.5, 'Onion' => 0.25, 'Chicken broth' => 3, 'Fresh thyme' => 1, 'Fresh parsley' => 1]);

        $this->createRecipe($diet, 'Quinoa and Black Bean Salad', 'lunch',
            'Toss quinoa with black beans, corn, bell pepper, and lime vinaigrette.', 20,
            ['Quinoa' => 1, 'Black beans' => 0.5, 'Bell pepper' => 0.5, 'Fresh cilantro' => 1, 'Lime juice' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Tuna Salad on Greens', 'lunch',
            'Mix tuna with Greek yogurt instead of mayo. Serve over mixed greens with vegetables.', 15,
            ['Tuna' => 1, 'Greek yogurt' => 0.25, 'Mixed greens' => 2, 'Cucumber' => 0.5, 'Cherry tomatoes' => 0.5, 'Lemon juice' => 1]);

        // Dinners
        $this->createRecipe($diet, 'Herb Baked Chicken with Sweet Potato', 'dinner',
            'Bake chicken breast with herbs. Serve with baked sweet potato and steamed broccoli.', 40,
            ['Chicken breast' => 1, 'Sweet potato' => 1, 'Broccoli' => 1, 'Olive oil' => 1, 'Fresh rosemary' => 1, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Grilled Fish with Vegetables', 'dinner',
            'Grill fish with lemon and herbs. Serve with roasted zucchini and bell peppers.', 25,
            ['Cod' => 1, 'Zucchini' => 1, 'Bell pepper' => 1, 'Lemon juice' => 1, 'Olive oil' => 1, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Turkey Meatballs with Pasta', 'dinner',
            'Bake turkey meatballs in marinara. Serve over whole wheat pasta with vegetables.', 40,
            ['Ground turkey' => 1, 'Whole wheat pasta' => 1, 'Diced tomatoes (canned)' => 1, 'Spinach' => 1, 'Garlic' => 1, 'Italian seasoning' => 0.5, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Salmon with Quinoa and Greens', 'dinner',
            'Bake salmon with lemon. Serve over quinoa with sautéed kale and garlic.', 30,
            ['Salmon fillet' => 1, 'Quinoa' => 1, 'Kale' => 2, 'Garlic' => 1, 'Lemon juice' => 1, 'Olive oil' => 1]);
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
            ['Sweet potato' => 1, 'Onion' => 0.25, 'Bell pepper' => 0.5, 'Eggs' => 2, 'Olive oil' => 1, 'Paprika' => 0.5]);

        $this->createRecipe($diet, 'Chia Pudding', 'breakfast',
            'Mix chia seeds with coconut milk overnight. Top with fresh fruit and coconut.', 5,
            ['Chia seeds' => 3, 'Coconut milk' => 1, 'Strawberries' => 0.5, 'Honey' => 1]);

        $this->createRecipe($diet, 'Banana Almond Smoothie', 'breakfast',
            'Blend banana, almond butter, almond milk, and a handful of spinach.', 5,
            ['Banana' => 1, 'Almond butter' => 2, 'Almond milk' => 1, 'Spinach' => 0.5]);

        // Lunches
        $this->createRecipe($diet, 'Rice Paper Spring Rolls', 'lunch',
            'Fill rice paper with shrimp, rice noodles, vegetables, and fresh herbs. Serve with peanut sauce.', 30,
            ['Shrimp' => 0.75, 'Rice noodles' => 0.5, 'Carrots' => 0.5, 'Cucumber' => 0.5, 'Fresh cilantro' => 1, 'Fresh mint' => 1]);

        $this->createRecipe($diet, 'Grilled Chicken Salad', 'lunch',
            'Top mixed greens with grilled chicken, avocado, tomatoes, and balsamic dressing.', 20,
            ['Mixed greens' => 2, 'Chicken breast' => 1, 'Avocado' => 0.5, 'Cherry tomatoes' => 0.5, 'Balsamic vinegar' => 1, 'Olive oil' => 2]);

        $this->createRecipe($diet, 'Stuffed Sweet Potato', 'lunch',
            'Bake sweet potato and stuff with black beans, salsa, avocado, and Greek yogurt.', 45,
            ['Sweet potato' => 1.5, 'Black beans' => 0.5, 'Avocado' => 0.5, 'Greek yogurt' => 0.25, 'Fresh cilantro' => 1, 'Lime juice' => 1]);

        $this->createRecipe($diet, 'Quinoa Tabbouleh', 'lunch',
            'Mix quinoa with cucumber, tomatoes, fresh parsley, mint, lemon, and olive oil.', 20,
            ['Quinoa' => 1, 'Cucumber' => 0.5, 'Tomatoes' => 0.5, 'Fresh parsley' => 2, 'Fresh mint' => 1, 'Lemon juice' => 2, 'Olive oil' => 2]);

        // Dinners
        $this->createRecipe($diet, 'Lemon Herb Salmon with Rice', 'dinner',
            'Bake salmon with lemon and herbs. Serve with brown rice and steamed vegetables.', 30,
            ['Salmon fillet' => 1, 'Brown rice' => 1, 'Asparagus' => 1, 'Lemon juice' => 1, 'Fresh dill' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Chicken Stir-Fry with Rice Noodles', 'dinner',
            'Stir-fry chicken with vegetables in coconut aminos. Serve over rice noodles.', 25,
            ['Chicken breast' => 1, 'Rice noodles' => 1, 'Broccoli' => 1, 'Bell pepper' => 0.5, 'Coconut aminos' => 2, 'Garlic' => 1, 'Ginger' => 0.5]);

        $this->createRecipe($diet, 'Shrimp and Vegetable Skewers', 'dinner',
            'Grill shrimp and vegetable skewers with olive oil and herbs. Serve with quinoa.', 25,
            ['Shrimp' => 1, 'Zucchini' => 1, 'Bell pepper' => 1, 'Cherry tomatoes' => 0.5, 'Quinoa' => 1, 'Olive oil' => 2, 'Italian seasoning' => 0.5]);

        $this->createRecipe($diet, 'Beef and Broccoli', 'dinner',
            'Stir-fry sliced beef with broccoli in gluten-free soy sauce. Serve over rice.', 25,
            ['Ground beef' => 1, 'Broccoli' => 2, 'Coconut aminos' => 2, 'Brown rice' => 1, 'Garlic' => 1, 'Ginger' => 0.5]);
    }

    private function seedLectinFree(): void
    {
        $diet = Diet::where('slug', 'lectin-free')->first();

        // Breakfasts
        $this->createRecipe($diet, 'Pasture-Raised Eggs with Greens', 'breakfast',
            'Scramble eggs and serve over sautéed kale and spinach with avocado.', 15,
            ['Eggs' => 3, 'Kale' => 1, 'Spinach' => 1, 'Avocado' => 0.5, 'Olive oil' => 1, 'Sea salt' => 0.25]);

        $this->createRecipe($diet, 'Coconut Yogurt with Berries', 'breakfast',
            'Top coconut yogurt with in-season berries and a sprinkle of walnuts.', 5,
            ['Coconut milk' => 1, 'Blueberries' => 0.5, 'Walnuts' => 0.25]);

        $this->createRecipe($diet, 'Smoked Salmon Plate', 'breakfast',
            'Serve wild-caught smoked salmon with avocado, capers, and fresh dill.', 10,
            ['Salmon fillet' => 1, 'Avocado' => 0.5, 'Capers' => 1, 'Fresh dill' => 1, 'Olive oil' => 1]);

        $this->createRecipe($diet, 'Sweet Potato and Sausage Skillet', 'breakfast',
            'Cook diced sweet potato with pasture-raised sausage and onions.', 25,
            ['Sweet potato' => 1, 'Pork tenderloin' => 0.5, 'Onion' => 0.25, 'Olive oil' => 1, 'Fresh rosemary' => 1]);

        // Lunches
        $this->createRecipe($diet, 'Wild Salmon Salad', 'lunch',
            'Top mixed greens with wild salmon, avocado, and olive oil dressing.', 15,
            ['Salmon fillet' => 1, 'Mixed greens' => 2, 'Avocado' => 0.5, 'Olive oil' => 2, 'Lemon juice' => 1]);

        $this->createRecipe($diet, 'Chicken Caesar (Lectin-Free)', 'lunch',
            'Romaine with grilled chicken, olive oil, lemon, and parmesan (no croutons).', 20,
            ['Romaine lettuce' => 2, 'Chicken breast' => 1, 'Parmesan cheese' => 2, 'Olive oil' => 2, 'Lemon juice' => 1]);

        $this->createRecipe($diet, 'Cauliflower Rice Bowl', 'lunch',
            'Serve seasoned cauliflower rice with grilled chicken, avocado, and greens.', 20,
            ['Cauliflower' => 2, 'Chicken breast' => 1, 'Avocado' => 0.5, 'Mixed greens' => 1, 'Olive oil' => 1, 'Lime juice' => 1]);

        $this->createRecipe($diet, 'Shrimp and Avocado Salad', 'lunch',
            'Toss grilled shrimp with avocado, cucumber, and citrus dressing.', 20,
            ['Shrimp' => 1, 'Avocado' => 0.5, 'Cucumber' => 0.5, 'Lime juice' => 1, 'Olive oil' => 2, 'Fresh cilantro' => 1]);

        // Dinners
        $this->createRecipe($diet, 'Grass-Fed Steak with Asparagus', 'dinner',
            'Pan-sear grass-fed steak. Roast asparagus with olive oil and garlic.', 25,
            ['Ground beef' => 1.5, 'Asparagus' => 2, 'Olive oil' => 2, 'Garlic' => 1, 'Fresh rosemary' => 1, 'Butter' => 2]);

        $this->createRecipe($diet, 'Baked Cod with Roasted Vegetables', 'dinner',
            'Bake wild-caught cod with olive oil and herbs. Serve with roasted broccoli and cauliflower.', 30,
            ['Cod' => 1, 'Broccoli' => 1, 'Cauliflower' => 1, 'Olive oil' => 2, 'Lemon juice' => 1, 'Fresh thyme' => 1]);

        $this->createRecipe($diet, 'Roasted Chicken with Sweet Potato', 'dinner',
            'Roast chicken thighs with herbs. Serve with mashed sweet potato and sautéed greens.', 45,
            ['Chicken breast' => 1.25, 'Sweet potato' => 1, 'Kale' => 2, 'Olive oil' => 2, 'Fresh rosemary' => 1, 'Garlic' => 1]);

        $this->createRecipe($diet, 'Lamb Chops with Mint', 'dinner',
            'Grill lamb chops with olive oil and mint. Serve with roasted cauliflower.', 25,
            ['Pork tenderloin' => 1, 'Cauliflower' => 2, 'Fresh mint' => 2, 'Olive oil' => 2, 'Garlic' => 1, 'Sea salt' => 0.5]);
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
