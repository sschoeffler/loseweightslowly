<x-app-layout>
    <x-slot name="title">Browse Healthy Recipes</x-slot>
    <x-slot name="metaDescription">Browse {{ $recipes->total() }} healthy recipes for weight loss. Filter by diet, cuisine, and meal type. Find breakfast, lunch, and dinner ideas.</x-slot>
    <x-slot name="headExtra">
        <meta property="og:title" content="Browse Healthy Recipes | Lose Weight Slowly">
        <meta property="og:description" content="Browse {{ $recipes->total() }} healthy recipes for weight loss. Filter by diet, cuisine, and meal type.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/recipes') }}">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Browse Recipes</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Filter Bar --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('recipes.index') }}" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[150px]">
                        <label for="diet" class="block text-sm font-medium text-gray-700 mb-1">Diet</label>
                        <select name="diet" id="diet" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            <option value="">All Diets</option>
                            @foreach($diets as $diet)
                            <option value="{{ $diet->slug }}" {{ request('diet') === $diet->slug ? 'selected' : '' }}>{{ $diet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label for="cuisine" class="block text-sm font-medium text-gray-700 mb-1">Cuisine</label>
                        <select name="cuisine" id="cuisine" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            <option value="">All Cuisines</option>
                            @foreach($cuisines as $cuisine)
                            <option value="{{ $cuisine->slug }}" {{ request('cuisine') === $cuisine->slug ? 'selected' : '' }}>{{ $cuisine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label for="meal_type" class="block text-sm font-medium text-gray-700 mb-1">Meal Type</label>
                        <select name="meal_type" id="meal_type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                            <option value="">All Meals</option>
                            @foreach($mealTypes as $type)
                            <option value="{{ $type }}" {{ request('meal_type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2 pb-px">
                        <button type="submit" class="h-[42px] bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 rounded-md transition-colors text-sm">
                            Filter
                        </button>
                        <a href="{{ route('recipes.index') }}" class="h-[42px] inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 rounded-md transition-colors text-sm">
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            {{-- Results count --}}
            <p class="text-sm text-gray-500 mb-4 px-1">{{ $recipes->total() }} {{ Str::plural('recipe', $recipes->total()) }} found</p>

            {{-- Recipe Card Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($recipes as $recipe)
                <a href="{{ route('recipe.show', $recipe) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow block">
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-800 mb-2 leading-snug">{{ $recipe->name }}</h3>
                        <div class="flex flex-wrap gap-1.5 mb-3">
                            <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full">{{ ucfirst($recipe->meal_type) }}</span>
                            <span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full">{{ $recipe->diet->name }}</span>
                            @if($recipe->cuisine)
                            <span class="text-xs bg-purple-50 text-purple-700 px-2 py-0.5 rounded-full">{{ $recipe->cuisine->name }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            @if($recipe->prep_time)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $recipe->prep_time }} min
                            </span>
                            @endif
                            @if($recipe->calories)
                            <span>{{ $recipe->calories }} cal</span>
                            @endif
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No recipes found matching your filters. <a href="{{ route('recipes.index') }}" class="text-emerald-600 hover:underline">Clear filters</a>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $recipes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
