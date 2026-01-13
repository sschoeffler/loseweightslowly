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
                    Select your preferred diet, choose your serving size, and get a complete 7-day meal plan with a ready-to-use shopping list.
                </p>
            </div>

            <form id="meal-plan-form" action="" method="GET" class="mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 1: Choose Your Diet</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($diets as $diet)
                        <label class="diet-card cursor-pointer">
                            <input type="radio" name="diet" value="{{ $diet->slug }}" class="sr-only peer" required>
                            <div class="border-2 rounded-lg p-4 transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:border-indigo-300">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $diet->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $diet->description }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Step 2: Select Servings</h2>
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
                        <p class="text-gray-600 text-sm">Pick from Mediterranean, Vegetarian, Keto, DASH, Gluten-Free, or Lectin-Free.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-xl font-bold">2</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Get Your Meal Plan</h3>
                        <p class="text-gray-600 text-sm">View a complete 7-day meal plan with breakfast, lunch, and dinner.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 text-xl font-bold">3</div>
                        <h3 class="font-semibold text-gray-800 mb-2">Shop with Ease</h3>
                        <p class="text-gray-600 text-sm">Get an organized shopping list with all ingredients measured by volume.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('meal-plan-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const diet = document.querySelector('input[name="diet"]:checked');
        if (!diet) {
            alert('Please select a diet type');
            return;
        }
        const servings = document.getElementById('servings').value;
        window.location.href = '/meal-plan/' + diet.value + '/' + servings;
    });
    </script>
</x-app-layout>
