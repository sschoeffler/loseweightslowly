<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Intermittent Fasting
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Intermittent Fasting Plans</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Choose a fasting schedule that fits your lifestyle. Start with the basics and progress as you get comfortable.
                </p>
            </div>

            {{-- Quick Start Timer --}}
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-8 mb-12 text-white text-center">
                <h2 class="text-2xl font-bold mb-2">Ready to Start Fasting?</h2>
                <p class="text-emerald-100 mb-4">Use our interactive timer to track your fasting window in real time.</p>
                <a href="{{ route('fasting.timer') }}" class="inline-block bg-white text-emerald-700 font-bold py-3 px-8 rounded-lg hover:bg-emerald-50 transition shadow-lg">
                    Open Fasting Timer
                </a>
            </div>

            {{-- Plans Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

                {{-- 16:8 --}}
                <a href="{{ route('fasting.plan', '16-8') }}" class="bg-white rounded-xl shadow-sm border-2 border-transparent hover:border-emerald-400 transition-all hover:shadow-md p-6 block group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full">Beginner</span>
                        <span class="text-gray-400 text-sm">16h fast / 8h eat</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-emerald-600 transition">16:8 Method</h3>
                    <p class="text-gray-500 text-sm mb-4">The most popular and sustainable approach. Skip breakfast, eat from noon to 8 PM.</p>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-emerald-500 h-3 rounded-full" style="width: 66.7%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>16h fasting</span>
                        <span>8h eating</span>
                    </div>
                </a>

                {{-- 18:6 --}}
                <a href="{{ route('fasting.plan', '18-6') }}" class="bg-white rounded-xl shadow-sm border-2 border-transparent hover:border-blue-400 transition-all hover:shadow-md p-6 block group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">Intermediate</span>
                        <span class="text-gray-400 text-sm">18h fast / 6h eat</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition">18:6 Method</h3>
                    <p class="text-gray-500 text-sm mb-4">A step up from 16:8. Two meals per day in a tighter window.</p>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-500 h-3 rounded-full" style="width: 75%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>18h fasting</span>
                        <span>6h eating</span>
                    </div>
                </a>

                {{-- 20:4 --}}
                <a href="{{ route('fasting.plan', '20-4') }}" class="bg-white rounded-xl shadow-sm border-2 border-transparent hover:border-purple-400 transition-all hover:shadow-md p-6 block group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full">Advanced</span>
                        <span class="text-gray-400 text-sm">20h fast / 4h eat</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition">20:4 Warrior Diet</h3>
                    <p class="text-gray-500 text-sm mb-4">One large meal plus a small snack. The Warrior Diet approach.</p>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-purple-500 h-3 rounded-full" style="width: 83.3%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>20h fasting</span>
                        <span>4h eating</span>
                    </div>
                </a>

                {{-- OMAD --}}
                <a href="{{ route('fasting.plan', 'omad') }}" class="bg-white rounded-xl shadow-sm border-2 border-transparent hover:border-red-400 transition-all hover:shadow-md p-6 block group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Advanced</span>
                        <span class="text-gray-400 text-sm">23h fast / 1h eat</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition">OMAD</h3>
                    <p class="text-gray-500 text-sm mb-4">One Meal A Day. Maximum fasting benefits with a single large meal.</p>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-red-500 h-3 rounded-full" style="width: 95.8%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>23h fasting</span>
                        <span>1h eating</span>
                    </div>
                </a>

                {{-- 5:2 --}}
                <a href="{{ route('fasting.plan', '5-2') }}" class="bg-white rounded-xl shadow-sm border-2 border-transparent hover:border-amber-400 transition-all hover:shadow-md p-6 block group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">Beginner</span>
                        <span class="text-gray-400 text-sm">Weekly schedule</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-600 transition">5:2 Diet</h3>
                    <p class="text-gray-500 text-sm mb-4">Eat normally 5 days, restrict to 500-600 calories on 2 non-consecutive days.</p>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden flex">
                        <div class="bg-amber-400 h-3" style="width: 28.6%"></div>
                        <div class="bg-gray-100 h-3" style="width: 14.3%"></div>
                        <div class="bg-amber-400 h-3" style="width: 42.8%"></div>
                        <div class="bg-gray-100 h-3" style="width: 14.3%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>5 normal days</span>
                        <span>2 fasting days</span>
                    </div>
                </a>

                {{-- Eat-Stop-Eat --}}
                <a href="{{ route('fasting.plan', 'eat-stop-eat') }}" class="bg-white rounded-xl shadow-sm border-2 border-transparent hover:border-indigo-400 transition-all hover:shadow-md p-6 block group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">Intermediate</span>
                        <span class="text-gray-400 text-sm">24h fasts</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition">Eat-Stop-Eat</h3>
                    <p class="text-gray-500 text-sm mb-4">One or two complete 24-hour fasts per week. Eat normally all other days.</p>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-indigo-500 h-3 rounded-full" style="width: 100%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>24h complete fast</span>
                        <span>1-2x per week</span>
                    </div>
                </a>
            </div>

            {{-- Info Section --}}
            <div class="bg-indigo-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-indigo-800 mb-4">What Is Intermittent Fasting?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">It's About When, Not What</h3>
                        <p class="text-gray-600 text-sm">Intermittent fasting doesn't change what you eat — it changes when you eat. By cycling between periods of eating and fasting, you give your body time to process and burn stored energy.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Safe for Most People</h3>
                        <p class="text-gray-600 text-sm">Most healthy adults can safely practice intermittent fasting. However, it's not recommended for pregnant/nursing women, children, people with eating disorders, or those with certain medical conditions. Consult your doctor first.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Combine with Meal Plans</h3>
                        <p class="text-gray-600 text-sm">Intermittent fasting pairs well with any of our <a href="{{ route('home') }}" class="text-indigo-600 hover:underline">meal plan diets</a>. Choose your diet, then use a fasting schedule to time your meals for maximum benefit.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
