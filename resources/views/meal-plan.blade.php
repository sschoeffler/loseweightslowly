<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $mealPlan['diets']->pluck('name')->join(' + ') }} Meal Plan</h2>
                <p class="text-gray-600 text-sm">7-day plan for {{ $mealPlan['servings'] }} {{ $mealPlan['servings'] === 1 ? 'person' : 'people' }}</p>
            </div>
            <div class="flex gap-3">
                <button onclick="printMealPlan()" class="no-print bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    Print / PDF
                </button>
                <a href="{{ route('shopping-list', array_merge(['diets' => $mealPlan['diets']->pluck('slug')->join(','), 'servings' => $mealPlan['servings']], request()->query())) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    View Shopping List
                </a>
                <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    Change Diet
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @foreach($mealPlan['days'] as $day => $meals)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-indigo-600 text-white px-6 py-3">
                        <h2 class="text-xl font-semibold">{{ $day }}</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach(['breakfast' => 'Breakfast', 'lunch' => 'Lunch', 'dinner' => 'Dinner'] as $mealKey => $mealLabel)
                            <div class="meal-card border rounded-lg p-4" data-meal-type="{{ $mealKey }}" data-diet-ids="{{ $mealPlan['diets']->pluck('id')->join(',') }}">
                                <h3 class="text-sm font-semibold text-indigo-600 uppercase tracking-wide mb-2">{{ $mealLabel }}</h3>
                                @if($meals[$mealKey])
                                <div class="meal-content" data-recipe-id="{{ $meals[$mealKey]->id }}">
                                    <div class="flex items-start justify-between gap-2 mb-2">
                                        <h4 class="recipe-name text-lg font-semibold text-gray-800">{{ $meals[$mealKey]->name }}</h4>
                                        <div class="flex gap-1 shrink-0">
                                            <button type="button"
                                                    class="preference-btn like-btn p-1.5 rounded hover:bg-green-100 transition-colors"
                                                    data-recipe-id="{{ $meals[$mealKey]->id }}"
                                                    data-preference="liked"
                                                    title="Like this recipe">
                                                <svg class="w-5 h-5 heart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                    class="preference-btn dislike-btn p-1.5 rounded hover:bg-red-100 transition-colors"
                                                    data-recipe-id="{{ $meals[$mealKey]->id }}"
                                                    data-preference="disliked"
                                                    title="Replace with another recipe">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="prep-time text-sm text-gray-500 mb-3">{{ $meals[$mealKey]->prep_time ? 'Prep time: ' . $meals[$mealKey]->prep_time . ' min' : '' }}</p>

                                    <details class="group">
                                        <summary class="cursor-pointer text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                            View ingredients & instructions
                                        </summary>
                                        <div class="mt-3 pt-3 border-t">
                                            <h5 class="text-sm font-semibold text-gray-700 mb-2">Ingredients:</h5>
                                            <ul class="ingredients-list text-sm text-gray-600 space-y-1 mb-3">
                                                @foreach($meals[$mealKey]->ingredients as $ingredient)
                                                <li>
                                                    @php
                                                        $qty = $ingredient->pivot->quantity * $mealPlan['servings'];
                                                        $unit = $ingredient->pivot->unit_override ?? $ingredient->unit;
                                                    @endphp
                                                    {{ number_format($qty, $qty == floor($qty) ? 0 : 1) }} {{ $unit }} {{ $ingredient->name }}
                                                </li>
                                                @endforeach
                                            </ul>
                                            <h5 class="text-sm font-semibold text-gray-700 mb-2">Instructions:</h5>
                                            <p class="instructions text-sm text-gray-600">{{ $meals[$mealKey]->instructions }}</p>
                                        </div>
                                    </details>
                                </div>
                                @else
                                <p class="text-gray-500 italic">No meal assigned</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('shopping-list', array_merge(['diets' => $mealPlan['diets']->pluck('slug')->join(','), 'servings' => $mealPlan['servings']], request()->query())) }}"
                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-lg text-xl transition-colors shadow-lg">
                    Get Shopping List
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const servings = {{ $mealPlan['servings'] }};
            const excludedRecipeIds = new Set();

            // Load existing preferences
            fetch('{{ route("recipe.preferences") }}')
                .then(response => response.json())
                .then(preferences => {
                    Object.entries(preferences).forEach(([recipeId, preference]) => {
                        updateButtonState(recipeId, preference);
                    });
                });

            // Handle like button clicks
            document.addEventListener('click', function(e) {
                const likeBtn = e.target.closest('.like-btn');
                if (likeBtn) {
                    const recipeId = likeBtn.dataset.recipeId;
                    togglePreference(recipeId, 'liked');
                }
            });

            // Handle dislike button clicks - replace the recipe
            document.addEventListener('click', function(e) {
                const dislikeBtn = e.target.closest('.dislike-btn');
                if (dislikeBtn) {
                    const recipeId = dislikeBtn.dataset.recipeId;
                    const mealCard = dislikeBtn.closest('.meal-card');
                    const mealType = mealCard.dataset.mealType;
                    const dietIds = mealCard.dataset.dietIds.split(',').map(id => parseInt(id));

                    // Save dislike preference
                    fetch('{{ route("recipe.preference") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            recipe_id: recipeId,
                            preference: 'disliked'
                        })
                    });

                    // Add to excluded list
                    excludedRecipeIds.add(parseInt(recipeId));

                    // Collect all currently displayed recipe IDs
                    const currentRecipeIds = Array.from(document.querySelectorAll('.meal-content'))
                        .map(el => parseInt(el.dataset.recipeId))
                        .filter(id => !isNaN(id));

                    const allExcluded = [...new Set([...excludedRecipeIds, ...currentRecipeIds])];

                    // Get replacement recipe
                    fetch('{{ route("recipe.replacement") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            diet_ids: dietIds,
                            meal_type: mealType,
                            exclude_ids: allExcluded,
                            servings: servings
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('No replacement available');
                        }
                        return response.json();
                    })
                    .then(recipe => {
                        replaceMealCard(mealCard, recipe);
                    })
                    .catch(error => {
                        alert('No more replacement recipes available for this meal type.');
                    });
                }
            });

            function togglePreference(recipeId, preference) {
                fetch('{{ route("recipe.preference") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        recipe_id: recipeId,
                        preference: preference
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'removed') {
                        clearButtonState(recipeId);
                    } else {
                        updateButtonState(recipeId, data.preference);
                    }
                });
            }

            function replaceMealCard(mealCard, recipe) {
                const mealContent = mealCard.querySelector('.meal-content');
                mealContent.dataset.recipeId = recipe.id;

                // Update recipe name
                mealContent.querySelector('.recipe-name').textContent = recipe.name;

                // Update prep time
                const prepTimeEl = mealContent.querySelector('.prep-time');
                prepTimeEl.textContent = recipe.prep_time ? `Prep time: ${recipe.prep_time} min` : '';

                // Update ingredients
                const ingredientsList = mealContent.querySelector('.ingredients-list');
                ingredientsList.innerHTML = recipe.ingredients.map(ing =>
                    `<li>${ing.quantity} ${ing.unit} ${ing.name}</li>`
                ).join('');

                // Update instructions
                mealContent.querySelector('.instructions').textContent = recipe.instructions;

                // Update button data attributes
                const likeBtn = mealContent.querySelector('.like-btn');
                const dislikeBtn = mealContent.querySelector('.dislike-btn');
                likeBtn.dataset.recipeId = recipe.id;
                dislikeBtn.dataset.recipeId = recipe.id;

                // Clear button states for the new recipe
                clearButtonState(recipe.id);

                // Add a visual flash to indicate the change
                mealCard.classList.add('bg-yellow-50');
                setTimeout(() => {
                    mealCard.classList.remove('bg-yellow-50');
                }, 500);
            }

            function updateButtonState(recipeId, preference) {
                const likeBtn = document.querySelector(`.like-btn[data-recipe-id="${recipeId}"]`);
                const dislikeBtn = document.querySelector(`.dislike-btn[data-recipe-id="${recipeId}"]`);

                if (likeBtn && dislikeBtn) {
                    clearButtonState(recipeId);

                    if (preference === 'liked') {
                        likeBtn.classList.add('bg-green-100', 'text-green-600');
                        likeBtn.querySelector('svg').setAttribute('fill', 'currentColor');
                    } else if (preference === 'disliked') {
                        dislikeBtn.classList.add('bg-red-100', 'text-red-600');
                    }
                }
            }

            function clearButtonState(recipeId) {
                const likeBtn = document.querySelector(`.like-btn[data-recipe-id="${recipeId}"]`);
                const dislikeBtn = document.querySelector(`.dislike-btn[data-recipe-id="${recipeId}"]`);

                if (likeBtn) {
                    likeBtn.classList.remove('bg-green-100', 'text-green-600');
                    likeBtn.querySelector('svg').setAttribute('fill', 'none');
                }
                if (dislikeBtn) {
                    dislikeBtn.classList.remove('bg-red-100', 'text-red-600');
                }
            }
        });

        // Print function - expands all details before printing
        function printMealPlan() {
            // Open all details elements
            const details = document.querySelectorAll('details');
            const previousStates = [];

            details.forEach((detail, index) => {
                previousStates[index] = detail.open;
                detail.open = true;
            });

            // Small delay to allow DOM to update
            setTimeout(() => {
                window.print();

                // Restore previous states after print dialog closes
                setTimeout(() => {
                    details.forEach((detail, index) => {
                        detail.open = previousStates[index];
                    });
                }, 100);
            }, 100);
        }
    </script>
</x-app-layout>
