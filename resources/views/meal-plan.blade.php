<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $mealPlan['diet']->name }} Meal Plan</h2>
                <p class="text-gray-600 text-sm">7-day plan for {{ $mealPlan['servings'] }} {{ $mealPlan['servings'] === 1 ? 'person' : 'people' }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('shopping-list', ['diet' => $mealPlan['diet']->slug, 'servings' => $mealPlan['servings']]) }}"
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
                            <div class="border rounded-lg p-4">
                                <h3 class="text-sm font-semibold text-indigo-600 uppercase tracking-wide mb-2">{{ $mealLabel }}</h3>
                                @if($meals[$mealKey])
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <h4 class="text-lg font-semibold text-gray-800">{{ $meals[$mealKey]->name }}</h4>
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
                                                title="Dislike this recipe">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @if($meals[$mealKey]->prep_time)
                                <p class="text-sm text-gray-500 mb-3">Prep time: {{ $meals[$mealKey]->prep_time }} min</p>
                                @endif

                                <details class="group">
                                    <summary class="cursor-pointer text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                        View ingredients & instructions
                                    </summary>
                                    <div class="mt-3 pt-3 border-t">
                                        <h5 class="text-sm font-semibold text-gray-700 mb-2">Ingredients:</h5>
                                        <ul class="text-sm text-gray-600 space-y-1 mb-3">
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
                                        <p class="text-sm text-gray-600">{{ $meals[$mealKey]->instructions }}</p>
                                    </div>
                                </details>
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
                <a href="{{ route('shopping-list', ['diet' => $mealPlan['diet']->slug, 'servings' => $mealPlan['servings']]) }}"
                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-lg text-xl transition-colors shadow-lg">
                    Get Shopping List
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Load existing preferences
            fetch('{{ route("recipe.preferences") }}')
                .then(response => response.json())
                .then(preferences => {
                    Object.entries(preferences).forEach(([recipeId, preference]) => {
                        updateButtonState(recipeId, preference);
                    });
                });

            // Handle preference button clicks
            document.querySelectorAll('.preference-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const recipeId = this.dataset.recipeId;
                    const preference = this.dataset.preference;

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
                });
            });

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
    </script>
</x-app-layout>
