<x-app-layout>
    <x-slot name="title">{{ $recipe->name }} Recipe</x-slot>
    <x-slot name="metaDescription">{{ $recipe->name }} — a healthy {{ $recipe->diet->name }} {{ $recipe->meal_type }} recipe{{ $recipe->cuisine ? ' with ' . $recipe->cuisine->name . ' flavors' : '' }}.{{ $recipe->calories ? ' ' . $recipe->calories . ' calories per serving.' : '' }}{{ $recipe->prep_time ? ' Ready in ' . $recipe->prep_time . ' minutes.' : '' }}</x-slot>
    <x-slot name="headExtra">
        <meta property="og:title" content="{{ $recipe->name }} | Lose Weight Slowly">
        <meta property="og:description" content="{{ $recipe->name }} — a healthy {{ $recipe->diet->name }} {{ $recipe->meal_type }} recipe.{{ $recipe->calories ? ' ' . $recipe->calories . ' cal.' : '' }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ url('/recipe/' . $recipe->slug) }}">
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Recipe',
            'name' => $recipe->name,
            'prepTime' => $recipe->prep_time ? 'PT' . $recipe->prep_time . 'M' : null,
            'recipeCategory' => ucfirst($recipe->meal_type),
            'recipeCuisine' => $recipe->cuisine?->name,
            'nutrition' => $recipe->calories ? [
                '@type' => 'NutritionInformation',
                'calories' => $recipe->calories . ' calories',
                'proteinContent' => $recipe->protein ? $recipe->protein . ' g' : null,
                'carbohydrateContent' => $recipe->carbs ? $recipe->carbs . ' g' : null,
                'fatContent' => $recipe->fat ? $recipe->fat . ' g' : null,
            ] : null,
            'recipeIngredient' => $recipe->ingredients->map(function ($i) {
                $qty = $i->pivot->quantity;
                $unit = $i->pivot->unit_override ?? $i->unit;
                return number_format($qty, $qty == floor($qty) ? 0 : 1) . ' ' . $unit . ' ' . $i->name;
            })->values()->toArray(),
            'recipeInstructions' => $recipe->instructions,
            'url' => url('/recipe/' . $recipe->slug),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    </x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $recipe->name }}</h2>
                <p class="text-gray-600 text-sm">
                    {{ ucfirst($recipe->meal_type) }}
                    @if($recipe->cuisine) &middot; {{ $recipe->cuisine->name }} @endif
                    &middot; {{ $recipe->diet->name }} Diet
                </p>
            </div>
            <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                Browse Meal Plans
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-wrap gap-3 mb-6">
                    @if($recipe->prep_time)
                    <span class="inline-flex items-center gap-1 text-sm bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $recipe->prep_time }} min
                    </span>
                    @endif
                    @if($recipe->calories)
                    <span class="text-sm bg-green-50 text-green-700 px-3 py-1 rounded-full">{{ $recipe->calories }} cal</span>
                    @endif
                    @if($recipe->protein)
                    <span class="text-sm bg-orange-50 text-orange-700 px-3 py-1 rounded-full">{{ $recipe->protein }}g protein</span>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Ingredients</h3>
                        <p class="text-xs text-gray-500 mb-3">Per serving</p>
                        <ul class="space-y-2">
                            @foreach($recipe->ingredients as $ingredient)
                            <li class="flex items-start gap-2 text-gray-700">
                                <span class="text-indigo-400 mt-1">&#8226;</span>
                                @php
                                    $qty = $ingredient->pivot->quantity;
                                    $unit = $ingredient->pivot->unit_override ?? $ingredient->unit;
                                @endphp
                                <span>{{ number_format($qty, $qty == floor($qty) ? 0 : 1) }} {{ $unit }} {{ $ingredient->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Instructions</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $recipe->instructions }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-5 mb-6 text-center">
                <p class="text-indigo-800 font-medium mb-2">Want a full week of meals like this?</p>
                <a href="{{ route('meal-plan', ['diets' => $recipe->diet->slug, 'servings' => 2]) }}{{ $recipe->cuisine ? '?cuisine=' . $recipe->cuisine->slug : '' }}"
                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Generate {{ $recipe->diet->name }} Meal Plan
                </a>
            </div>

            @if($relatedRecipes->isNotEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">More {{ $recipe->cuisine ? $recipe->cuisine->name : $recipe->diet->name }} Recipes</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($relatedRecipes as $related)
                    <a href="{{ route('recipe.show', $related) }}" class="block border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <h4 class="font-semibold text-gray-800 mb-1">{{ $related->name }}</h4>
                        <p class="text-sm text-gray-500">{{ ucfirst($related->meal_type) }} @if($related->prep_time)&middot; {{ $related->prep_time }} min @endif</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
