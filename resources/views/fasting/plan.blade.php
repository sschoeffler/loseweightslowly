{{-- Tailwind safelist — these dynamic classes must be present for the JIT compiler:
bg-emerald-50 bg-emerald-100 bg-emerald-200 bg-emerald-500 bg-emerald-600 text-emerald-100 text-emerald-600 text-emerald-700 text-emerald-800 border-emerald-300 border-emerald-400 from-emerald-500 to-emerald-600 hover:border-emerald-400
bg-blue-50 bg-blue-100 bg-blue-200 bg-blue-500 bg-blue-600 text-blue-100 text-blue-600 text-blue-700 text-blue-800 border-blue-300 border-blue-400 from-blue-500 to-blue-600 hover:border-blue-400
bg-purple-50 bg-purple-100 bg-purple-200 bg-purple-500 bg-purple-600 text-purple-100 text-purple-600 text-purple-700 text-purple-800 border-purple-300 border-purple-400 from-purple-500 to-purple-600 hover:border-purple-400
bg-red-50 bg-red-100 bg-red-200 bg-red-500 bg-red-600 text-red-100 text-red-600 text-red-700 text-red-800 border-red-300 border-red-400 from-red-500 to-red-600 hover:border-red-400
bg-amber-50 bg-amber-100 bg-amber-200 bg-amber-400 bg-amber-500 bg-amber-600 text-amber-100 text-amber-600 text-amber-700 text-amber-800 border-amber-300 border-amber-400 from-amber-500 to-amber-600 hover:border-amber-400
bg-indigo-50 bg-indigo-100 bg-indigo-200 bg-indigo-500 bg-indigo-600 text-indigo-100 text-indigo-600 text-indigo-700 text-indigo-800 border-indigo-300 border-indigo-400 from-indigo-500 to-indigo-600 hover:border-indigo-400
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $plan['name'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="mb-6 text-sm text-gray-500">
                <a href="{{ route('fasting.index') }}" class="text-indigo-600 hover:underline">Intermittent Fasting</a>
                <span class="mx-2">/</span>
                <span>{{ $plan['name'] }}</span>
            </div>

            {{-- Header --}}
            <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div>
                        <span class="bg-{{ $plan['color'] }}-100 text-{{ $plan['color'] }}-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $plan['difficulty'] }}</span>
                        <h1 class="text-3xl font-bold text-gray-800 mt-3 mb-2">{{ $plan['name'] }}</h1>
                        <p class="text-gray-500 text-lg">{{ $plan['subtitle'] }}</p>
                    </div>
                    @if($plan['fasting_hours'] > 0)
                    <div class="text-center bg-gray-50 rounded-xl p-4 min-w-[120px]">
                        <p class="text-3xl font-bold text-{{ $plan['color'] }}-600">{{ $plan['fasting_hours'] }}h</p>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Fasting</p>
                        <div class="border-t border-gray-200 my-2"></div>
                        <p class="text-xl font-bold text-gray-600">{{ $plan['eating_hours'] }}h</p>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Eating</p>
                    </div>
                    @endif
                </div>

                <div class="mt-6">
                    <p class="text-gray-600 leading-relaxed">{{ $plan['description'] }}</p>
                </div>

                @if($plan['fasting_hours'] > 0)
                <div class="mt-6">
                    <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden flex">
                        <div class="bg-{{ $plan['color'] }}-500 h-4 flex items-center justify-center text-white text-xs font-medium" style="width: {{ ($plan['fasting_hours'] / 24) * 100 }}%">
                            {{ $plan['fasting_hours'] }}h fast
                        </div>
                        <div class="bg-{{ $plan['color'] }}-200 h-4 flex items-center justify-center text-{{ $plan['color'] }}-800 text-xs font-medium" style="width: {{ ($plan['eating_hours'] / 24) * 100 }}%">
                            {{ $plan['eating_hours'] }}h eat
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-8">
                {{-- How It Works --}}
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">How It Works</h2>
                    <ol class="space-y-3">
                        @foreach($plan['how_it_works'] as $i => $step)
                        <li class="flex items-start gap-3">
                            <span class="bg-{{ $plan['color'] }}-100 text-{{ $plan['color'] }}-700 rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">{{ $i + 1 }}</span>
                            <span class="text-gray-600 text-sm">{{ $step }}</span>
                        </li>
                        @endforeach
                    </ol>
                </div>

                {{-- Benefits --}}
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Benefits</h2>
                    <ul class="space-y-3">
                        @foreach($plan['benefits'] as $benefit)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-{{ $plan['color'] }}-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600 text-sm">{{ $benefit }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Sample Schedule --}}
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Sample Schedule</h2>
                <div class="space-y-3">
                    @foreach($plan['sample_schedule'] as $time => $activity)
                    <div class="flex items-center gap-4 p-3 rounded-lg {{ str_contains(strtolower($activity), 'fast') || str_contains(strtolower($activity), 'water') || str_contains(strtolower($activity), 'sleep') || str_contains(strtolower($activity), 'wake') ? 'bg-gray-50' : 'bg-' . $plan['color'] . '-50' }}">
                        <span class="font-mono text-sm font-semibold text-gray-700 w-28 flex-shrink-0">{{ $time }}</span>
                        <span class="text-gray-600 text-sm">{{ $activity }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Tips --}}
            <div class="bg-amber-50 rounded-xl p-6 mb-8">
                <h2 class="text-lg font-semibold text-amber-800 mb-4">Tips for Success</h2>
                <ul class="space-y-2">
                    @foreach($plan['tips'] as $tip)
                    <li class="flex items-start gap-2 text-sm text-amber-700">
                        <span class="text-amber-500 mt-1">&#9679;</span>
                        <span>{{ $tip }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Start Timer CTA --}}
            <div class="bg-gradient-to-r from-{{ $plan['color'] }}-500 to-{{ $plan['color'] }}-600 rounded-xl p-8 text-white text-center mb-8">
                <h2 class="text-xl font-bold mb-2">Start Your {{ $plan['name'] }} Fast</h2>
                <p class="text-{{ $plan['color'] }}-100 mb-4">Track your fasting window with our interactive timer.</p>
                <a href="{{ route('fasting.timer') }}" class="inline-block bg-white text-{{ $plan['color'] }}-700 font-bold py-3 px-8 rounded-lg hover:bg-gray-50 transition">
                    Open Fasting Timer
                </a>
            </div>

            {{-- Other Plans --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Other Fasting Plans</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($allPlans as $key => $other)
                        @if($key !== $slug)
                        <a href="{{ route('fasting.plan', $key) }}" class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition border border-transparent hover:border-{{ $other['color'] }}-300">
                            <h3 class="font-semibold text-gray-800 text-sm">{{ $other['name'] }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $other['difficulty'] }}</p>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
