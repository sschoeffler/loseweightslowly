<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Weekly Meal Planning
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Weekly Meal Planning Made Easy</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Select your preferred diet, customize your filters, and get a complete 7-day meal plan with a ready-to-use shopping list.
                </p>
            </div>

            <form id="meal-plan-form" action="" method="GET" class="mb-8">
                <!-- Step 1: Diet Selection -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 1: Choose Your Diet(s)</h2>
                    <p class="text-sm text-gray-500 mb-4">Select one or more diets to combine (e.g., Keto + Mediterranean)</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($diets as $diet)
                        <label class="diet-card cursor-pointer">
                            <input type="checkbox" name="diets[]" value="{{ $diet->slug }}" class="sr-only peer">
                            <div class="border-2 rounded-lg p-4 transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:border-indigo-300 h-full">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $diet->name }}</h3>
                                <p class="text-xs text-gray-600">{{ Str::limit($diet->description, 100) }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Step 2: Filters (Collapsible) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                    <details class="group">
                        <summary class="flex items-center justify-between cursor-pointer">
                            <h2 class="text-2xl font-semibold text-gray-800">Step 2: Customize Filters (Optional)</h2>
                            <span class="text-indigo-600 group-open:rotate-180 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </summary>

                        <div class="mt-6 space-y-6">
                            <!-- Cuisine Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Cuisine Preference
                                </label>
                                <select name="cuisine" id="cuisine" class="block w-full max-w-md rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                                    <option value="">Any Cuisine</option>
                                    @foreach($cuisines as $category => $cuisineGroup)
                                    <optgroup label="{{ $category }}">
                                        @foreach($cuisineGroup as $cuisine)
                                        <option value="{{ $cuisine->slug }}">{{ $cuisine->name }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Allergen Exclusions -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Exclude Allergens
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                                    @foreach($allergens as $allergen)
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" name="exclude_allergens[]" value="{{ $allergen->slug }}"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">{{ $allergen->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Prep Time Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Maximum Prep Time
                                </label>
                                <select name="max_prep_time" id="max_prep_time" class="block w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                                    <option value="">Any Time</option>
                                    <option value="15">Quick (under 15 min)</option>
                                    <option value="30">Medium (under 30 min)</option>
                                    <option value="45">Standard (under 45 min)</option>
                                    <option value="60">Extended (under 1 hour)</option>
                                </select>
                            </div>

                            <!-- Budget Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Budget Level
                                </label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="budget" value="" checked
                                               class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">Any</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="budget" value="budget"
                                               class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">Budget-Friendly</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="budget" value="moderate"
                                               class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">Moderate</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="budget" value="premium"
                                               class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">Premium</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Additional Options -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Additional Options
                                </label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="checkbox" name="meal_prep_friendly" value="1"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="text-sm text-gray-700">Meal Prep Friendly</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>

                <!-- Step 3: Servings -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 3: Select Servings</h2>
                    <div class="max-w-xs">
                        <label for="servings" class="block text-sm font-medium text-gray-700 mb-2">
                            Number of people to feed
                        </label>
                        <select name="servings" id="servings" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-3 border">
                            <option value="1">1 person</option>
                            <option value="2" selected>2 people</option>
                            <option value="3">3 people</option>
                            <option value="4">4 people</option>
                            <option value="5">5 people</option>
                            <option value="6">6 people</option>
                        </select>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-lg text-xl transition-colors shadow-lg">
                        Generate My Meal Plan
                    </button>
                </div>
            </form>

            <div class="bg-indigo-50 rounded-lg p-6 mt-12">
                <h2 class="text-xl font-semibold text-indigo-800 mb-4">How It Works</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-xl font-bold">1</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Choose Your Diet</h3>
                        <p class="text-gray-600 text-sm">Pick from 14 diet types including Mediterranean, Keto, Vegan, Kosher, Halal, and more.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-xl font-bold">2</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Get Your Meal Plan</h3>
                        <p class="text-gray-600 text-sm">View a complete 7-day meal plan with breakfast, lunch, and dinner. Like or dislike recipes.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-xl font-bold">3</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Shop with Ease</h3>
                        <p class="text-gray-600 text-sm">Get an organized shopping list with all ingredients measured and grouped by category.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('meal-plan-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const selectedDiets = document.querySelectorAll('input[name="diets[]"]:checked');
        if (selectedDiets.length === 0) {
            alert('Please select at least one diet type');
            return;
        }

        // Get diet slugs as comma-separated string
        const dietSlugs = Array.from(selectedDiets).map(el => el.value).join(',');
        const servings = document.getElementById('servings').value;

        // Build URL with filters
        let url = '/meal-plan/' + dietSlugs + '/' + servings;

        // Add query parameters for filters
        const params = new URLSearchParams();

        const cuisine = document.getElementById('cuisine').value;
        if (cuisine) params.append('cuisine', cuisine);

        const maxPrepTime = document.getElementById('max_prep_time').value;
        if (maxPrepTime) params.append('max_prep_time', maxPrepTime);

        const budget = document.querySelector('input[name="budget"]:checked');
        if (budget && budget.value) params.append('budget', budget.value);

        const mealPrepFriendly = document.querySelector('input[name="meal_prep_friendly"]:checked');
        if (mealPrepFriendly) params.append('meal_prep_friendly', '1');

        const excludeAllergens = document.querySelectorAll('input[name="exclude_allergens[]"]:checked');
        excludeAllergens.forEach(el => params.append('exclude_allergens[]', el.value));

        if (params.toString()) {
            url += '?' + params.toString();
        }

        window.location.href = url;
    });
    </script>
</x-app-layout>
