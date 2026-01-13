@extends('layouts.app')

@section('title', 'Shopping List - ' . $diet->name)

@section('content')
<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Shopping List</h1>
            <p class="text-gray-600 mt-1">{{ $diet->name }} diet for {{ $servings }} {{ $servings === 1 ? 'person' : 'people' }} (7 days)</p>
        </div>
        <div class="flex gap-3 no-print">
            <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                Print List
            </button>
            <a href="{{ route('meal-plan', ['diet' => $diet->slug, 'servings' => $servings]) }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors">
                View Meal Plan
            </a>
            <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors">
                Change Diet
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($shoppingList as $category => $items)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-700 text-white px-4 py-3">
            <h2 class="text-lg font-semibold">{{ $category }}</h2>
        </div>
        <ul class="divide-y divide-gray-100">
            @foreach($items as $item)
            <li class="px-4 py-3 flex items-center gap-3">
                <input type="checkbox" class="h-5 w-5 rounded border-gray-300 text-green-600 focus:ring-green-500">
                <span class="flex-1">
                    <span class="font-medium text-gray-800">{{ $item['name'] }}</span>
                    <span class="text-gray-500 text-sm ml-2">
                        {{ $aggregator->formatQuantity($item['quantity'], $item['unit']) }}
                    </span>
                </span>
            </li>
            @endforeach
        </ul>
    </div>
    @endforeach
</div>

<div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6 no-print">
    <h2 class="text-lg font-semibold text-yellow-800 mb-2">Shopping Tips</h2>
    <ul class="text-yellow-700 space-y-1">
        <li>Check your pantry first - you may already have some herbs and spices.</li>
        <li>Buy fresh produce mid-week to ensure freshness for later meals.</li>
        <li>Consider buying proteins in bulk and freezing portions.</li>
        <li>Adjust quantities based on your local store packaging.</li>
    </ul>
</div>

<div class="mt-8 text-center no-print">
    <a href="{{ route('meal-plan', ['diet' => $diet->slug, 'servings' => $servings]) }}"
       class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
        Back to Meal Plan
    </a>
</div>
@endsection
