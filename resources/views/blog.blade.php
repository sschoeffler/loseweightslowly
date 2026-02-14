<x-app-layout>
    <x-slot name="title">Blog</x-slot>
    <x-slot name="metaDescription">Tips, science, and strategies for sustainable weight loss. Healthy recipes, meal planning advice, and nutrition insights from Lose Weight Slowly.</x-slot>
    <x-slot name="headExtra">
        <meta property="og:title" content="Blog | Lose Weight Slowly">
        <meta property="og:description" content="Tips, science, and strategies for sustainable weight loss. Healthy recipes, meal planning advice, and nutrition insights.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/blog') }}">
        <meta property="og:image" content="{{ route('og-image.default') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ route('og-image.default') }}">
        <link rel="canonical" href="{{ url('/blog') }}">
    </x-slot>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Blog</h2>
            <p class="text-gray-500 text-sm mt-1">Science-backed tips for sustainable weight loss</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Post 1 -->
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-xs bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full font-medium">Science</span>
                    <span class="text-sm text-gray-400">February 14, 2026</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 leading-snug">Why Losing Weight Slowly Actually Works Better</h2>
                <p class="text-gray-600 leading-relaxed mb-4">The diet industry sells speed. Drop 10 pounds in a week. Shed a dress size by Friday. But the research tells a consistent story: <strong>people who lose weight gradually are far more likely to keep it off.</strong></p>
                <p class="text-gray-600 leading-relaxed mb-4">A landmark study published in <em>Obesity</em> followed participants for two years after weight loss. Those who lost 1-2 pounds per week maintained significantly more of their loss than rapid dieters. The reason isn't just willpower — it's biology. Crash diets trigger adaptive thermogenesis, where your metabolism slows dramatically to compensate for the sudden calorie deficit. Slow, steady changes let your body adjust without triggering these defense mechanisms.</p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">What "Slow" Actually Means</h3>
                <ul class="space-y-2 mb-4">
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>A 300-500 calorie daily deficit</strong> — enough to lose weight, small enough that you're not hungry all day.</span>
                    </li>
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>No food groups eliminated</strong> — restrictive diets create cravings that lead to bingeing. Eat everything, just adjust portions.</span>
                    </li>
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>1-2 pounds per week</strong> — boring to watch on the scale, transformative over six months.</span>
                    </li>
                </ul>

                <div class="border-l-4 border-indigo-400 bg-indigo-50 px-4 py-3 rounded-r-lg my-6">
                    <p class="text-gray-700 italic">The goal isn't to lose weight as fast as possible. The goal is to lose weight in a way that you never have to lose it again.</p>
                </div>

                <p class="text-gray-600 leading-relaxed mb-4">This is why meal planning matters. When you plan your meals for the week, you're not relying on willpower at 7 PM when you're exhausted. The decision is already made. The ingredients are already in your fridge.</p>

                <a href="{{ route('home') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-5 rounded-lg transition-colors text-sm mt-2">Build a Meal Plan</a>
            </article>

            <!-- Post 2 -->
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-xs bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-full font-medium">Nutrition</span>
                    <span class="text-sm text-gray-400">February 10, 2026</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 leading-snug">Protein Is the Most Important Nutrient for Weight Loss (Here's Why)</h2>
                <p class="text-gray-600 leading-relaxed mb-4">If you could change one thing about your diet to lose weight more effectively, it would be this: eat more protein. Not because of some fad diet logic, but because protein fundamentally changes how your body handles hunger, muscle, and metabolism.</p>
                <p class="text-gray-600 leading-relaxed mb-4">Protein has the highest thermic effect of any macronutrient. Your body uses <strong>20-30% of protein calories just to digest it</strong>, compared to 5-10% for carbs and 0-3% for fat. That means 100 calories of chicken breast costs your body 25 calories to process. 100 calories of butter costs about 2.</p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">The Satiety Advantage</h3>
                <p class="text-gray-600 leading-relaxed mb-4">Protein is also the most satiating macronutrient. Studies show that people who increase protein to 25-30% of calories spontaneously eat 400 fewer calories per day — without counting, restricting, or feeling deprived. Protein reduces ghrelin (your hunger hormone) and boosts peptide YY (your fullness hormone). You're not fighting cravings. You're just less hungry.</p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">How Much Do You Need?</h3>
                <ul class="space-y-2 mb-4">
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>Minimum:</strong> 0.7g per pound of body weight if you're active</span>
                    </li>
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>Sweet spot:</strong> 25-35g per meal, spread across the day</span>
                    </li>
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>Easy wins:</strong> Greek yogurt at breakfast, chicken or fish at lunch, beans or tofu at dinner</span>
                    </li>
                </ul>

                <div class="border-l-4 border-indigo-400 bg-indigo-50 px-4 py-3 rounded-r-lg my-6">
                    <p class="text-gray-700 italic">You don't need a protein shake. You need a meal plan where every meal has a real protein source. That alone changes everything.</p>
                </div>

                <p class="text-gray-600 leading-relaxed mb-4">Every recipe on this site shows protein per serving. Use that number. Aim for meals in the 25-40g range, and you'll notice the difference within a week — not on the scale, but in how rarely you think about snacking.</p>

                <a href="{{ route('recipes.index') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-5 rounded-lg transition-colors text-sm mt-2">Browse High-Protein Recipes</a>
            </article>

            <!-- Post 3 -->
            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-xs bg-orange-50 text-orange-700 px-2.5 py-1 rounded-full font-medium">Strategy</span>
                    <span class="text-sm text-gray-400">February 5, 2026</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 leading-snug">The Meal Prep Myth: You Don't Need to Spend Sunday in the Kitchen</h2>
                <p class="text-gray-600 leading-relaxed mb-4">Every meal prep guide starts the same way: spend 3-4 hours on Sunday cooking a week's worth of food. Pack it in identical containers. Eat the same chicken and rice for five days straight. For most people, this lasts exactly two weeks before they quit.</p>
                <p class="text-gray-600 leading-relaxed mb-4"><strong>The problem isn't lack of discipline — it's that the approach is unsustainable.</strong> Eating the same meal five days in a row gets boring. Reheated food loses its appeal. And devoting half your weekend to cooking feels like punishment, not progress.</p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">A Better Approach: Plan, Don't Prep</h3>
                <p class="text-gray-600 leading-relaxed mb-4">Instead of batch cooking everything, try this: plan your meals for the week, shop for the ingredients, and cook each meal fresh in under 30 minutes. Most healthy meals don't need hours of prep — they need a plan and the right ingredients in your fridge.</p>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">What This Looks Like in Practice</h3>
                <ul class="space-y-2 mb-4">
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>Saturday:</strong> Generate a meal plan based on your diet. Print the shopping list.</span>
                    </li>
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>Sunday:</strong> One grocery trip. Everything you need for 7 days of meals.</span>
                    </li>
                    <li class="flex items-start gap-2 text-gray-600">
                        <span class="text-emerald-400 mt-1.5">&#8226;</span>
                        <span><strong>Each evening:</strong> Cook a different recipe in 15-30 minutes. Fresh, varied, no containers.</span>
                    </li>
                </ul>

                <div class="border-l-4 border-indigo-400 bg-indigo-50 px-4 py-3 rounded-r-lg my-6">
                    <p class="text-gray-700 italic">The best meal plan is the one you actually follow. Variety beats efficiency every time.</p>
                </div>

                <p class="text-gray-600 leading-relaxed mb-4">This is exactly what our meal plans are designed for. Pick your diet, choose your servings, and get a full week of different recipes with an auto-generated shopping list. No containers. No reheating. Just real meals every night.</p>

                <a href="{{ route('home') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-5 rounded-lg transition-colors text-sm mt-2">Generate a Meal Plan</a>
            </article>

        </div>
    </div>
</x-app-layout>
