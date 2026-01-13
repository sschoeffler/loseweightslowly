@extends('layouts.app')

@section('title', $mealPlan['diet']->name . ' Meal Plan')

@section('content')
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $mealPlan['diet']->name }} Meal Plan</h1>
            <p class="text-gray-600 mt-1">7-day plan for {{ $mealPlan['servings'] }} {{ $mealPlan['servings'] === 1 ? 'person' : 'people' }}</p>
        </div>
        <div class="flex gap-3 no-print">
            <a href="{{ route('shopping-list', ['diet' => $mealPlan['diet']->slug, 'servings' => $mealPlan['servings']]) }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                View Shopping List
            </a>
            <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors">
                Change Diet
            </a>
        </div>
    </div>
</div>

<div class="space-y-6">
    @foreach($mealPlan['days'] as $day => $meals)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-green-600 text-white px-6 py-3">
            <h2 class="text-xl font-semibold">{{ $day }}</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(['breakfast' => 'Breakfast', 'lunch' => 'Lunch', 'dinner' => 'Dinner'] as $mealKey => $mealLabel)
                <div class="border rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-green-600 uppercase tracking-wide mb-2">{{ $mealLabel }}</h3>
                    @if($meals[$mealKey])
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $meals[$mealKey]->name }}</h4>
                    @if($meals[$mealKey]->prep_time)
                    <p class="text-sm text-gray-500 mb-3">Prep time: {{ $meals[$mealKey]->prep_time }} min</p>
                    @endif

                    <details class="group">
                        <summary class="cursor-pointer text-sm text-green-600 hover:text-green-800 font-medium">
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

<div class="mt-8 text-center no-print">
    <a href="{{ route('shopping-list', ['diet' => $mealPlan['diet']->slug, 'servings' => $mealPlan['servings']]) }}"
       class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded-lg text-xl transition-colors shadow-lg">
        Get Shopping List
    </a>
</div>
@endsection
