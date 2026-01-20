<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shopping List</h2>
                <p class="text-gray-600 text-sm">{{ $diet->name }} diet for {{ $servings }} {{ $servings === 1 ? 'person' : 'people' }} (7 days)</p>
            </div>
            <div class="flex gap-3 no-print">
                <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    Print / PDF
                </button>
                <a href="{{ route('meal-plan', array_merge(['diet' => $diet->slug, 'servings' => $servings], request()->query())) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    View Meal Plan
                </a>
                <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    Change Diet
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($shoppingList as $category => $items)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-gray-700 text-white px-4 py-3">
                        <h2 class="text-lg font-semibold">{{ $category }}</h2>
                    </div>
                    <ul class="divide-y divide-gray-100">
                        @foreach($items as $item)
                        <li class="px-4 py-3 flex items-center gap-3">
                            <input type="checkbox" class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
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
                <a href="{{ route('meal-plan', array_merge(['diet' => $diet->slug, 'servings' => $servings], request()->query())) }}"
                   class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    Back to Meal Plan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
