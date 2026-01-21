<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shopping List</h2>
                <p class="text-gray-600 text-sm">{{ $diets->pluck('name')->join(' + ') }} diet for {{ $servings }} {{ $servings === 1 ? 'person' : 'people' }} (7 days)</p>
            </div>
            <div class="flex gap-3 no-print">
                <button onclick="printShoppingList()" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    Print Checked Items
                </button>
                <a href="{{ route('meal-plan', array_merge(['diets' => $diets->pluck('slug')->join(','), 'servings' => $servings], request()->query())) }}"
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
            <!-- Check/Uncheck All Buttons -->
            <div class="mb-4 flex gap-3 no-print">
                <button onclick="checkAll()" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    Check All
                </button>
                <button onclick="uncheckAll()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg transition-colors text-sm">
                    Uncheck All
                </button>
                <span class="text-sm text-gray-500 self-center ml-2">Only checked items will be printed</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="shopping-list-grid">
                @foreach($shoppingList as $category => $items)
                <div class="category-card bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-gray-700 text-white px-4 py-3">
                        <h2 class="text-lg font-semibold">{{ $category }}</h2>
                    </div>
                    <ul class="divide-y divide-gray-100">
                        @foreach($items as $item)
                        <li class="shopping-item px-4 py-3 flex items-center gap-3">
                            <input type="checkbox" checked class="item-checkbox h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
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
                <a href="{{ route('meal-plan', array_merge(['diets' => $diets->pluck('slug')->join(','), 'servings' => $servings], request()->query())) }}"
                   class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    Back to Meal Plan
                </a>
            </div>
        </div>
    </div>

    <script>
        function checkAll() {
            document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = true);
        }

        function uncheckAll() {
            document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = false);
        }

        function printShoppingList() {
            // Hide unchecked items before printing
            const items = document.querySelectorAll('.shopping-item');
            const hiddenItems = [];

            items.forEach(item => {
                const checkbox = item.querySelector('.item-checkbox');
                if (!checkbox.checked) {
                    item.style.display = 'none';
                    hiddenItems.push(item);
                }
            });

            // Hide empty category cards
            const categoryCards = document.querySelectorAll('.category-card');
            const hiddenCards = [];

            categoryCards.forEach(card => {
                const visibleItems = card.querySelectorAll('.shopping-item:not([style*="display: none"])');
                if (visibleItems.length === 0) {
                    card.style.display = 'none';
                    hiddenCards.push(card);
                }
            });

            // Print
            window.print();

            // Restore hidden items after print dialog closes
            setTimeout(() => {
                hiddenItems.forEach(item => item.style.display = '');
                hiddenCards.forEach(card => card.style.display = '');
            }, 100);
        }
    </script>
</x-app-layout>
