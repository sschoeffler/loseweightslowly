<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Fasting Timer
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8" x-data="fastingTimer()" x-init="init()">

            {{-- Plan Selector --}}
            <div x-show="!isActive && !isComplete" class="mb-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Start a Fast</h1>
                    <p class="text-gray-500">Choose your fasting plan, then start the timer.</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Select Fasting Plan</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <template x-for="plan in plans" :key="plan.id">
                            <button @click="selectedPlan = plan"
                                :class="selectedPlan?.id === plan.id ? 'border-indigo-500 bg-indigo-50 ring-2 ring-indigo-200' : 'border-gray-200 hover:border-indigo-300'"
                                class="border-2 rounded-lg p-3 text-left transition cursor-pointer">
                                <p class="font-semibold text-sm text-gray-800" x-text="plan.name"></p>
                                <p class="text-xs text-gray-400" x-text="plan.label"></p>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Custom duration --}}
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6" x-show="selectedPlan?.id === 'custom'">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Custom Fasting Duration (hours)</label>
                    <input type="number" x-model.number="customHours" min="1" max="72" class="border border-gray-200 rounded-lg px-4 py-2 w-32 text-center text-lg focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                </div>

                <div class="text-center">
                    <button @click="startFast()"
                        :disabled="!selectedPlan"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-12 rounded-xl text-lg transition shadow-lg disabled:opacity-40 disabled:cursor-not-allowed">
                        Start Fasting
                    </button>
                </div>
            </div>

            {{-- Active Fast --}}
            <div x-show="isActive" class="text-center">
                <div class="bg-white rounded-2xl shadow-sm p-8 mb-6">
                    <p class="text-sm font-medium text-indigo-600 uppercase tracking-wider mb-2" x-text="activePlanName + ' Fast'"></p>

                    {{-- Circular Progress --}}
                    <div class="relative w-64 h-64 mx-auto mb-6">
                        <svg class="w-full h-full -rotate-90" viewBox="0 0 200 200">
                            <circle cx="100" cy="100" r="90" fill="none" stroke="#f3f4f6" stroke-width="8" />
                            <circle cx="100" cy="100" r="90" fill="none" stroke="#6366f1" stroke-width="8"
                                stroke-linecap="round"
                                :stroke-dasharray="565.48"
                                :stroke-dashoffset="565.48 * (1 - progress)" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <p class="text-4xl font-bold text-gray-800" x-text="timeDisplay"></p>
                            <p class="text-sm text-gray-400" x-text="isActive ? 'remaining' : ''"></p>
                            <p class="text-lg font-semibold mt-1" :class="progress < 0.5 ? 'text-indigo-600' : progress < 0.8 ? 'text-amber-600' : 'text-emerald-600'" x-text="Math.round(progress * 100) + '%'"></p>
                        </div>
                    </div>

                    {{-- Elapsed / Total --}}
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Elapsed</p>
                            <p class="font-semibold text-gray-800" x-text="elapsedDisplay"></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-400 uppercase tracking-wider">Goal</p>
                            <p class="font-semibold text-gray-800" x-text="goalHours + 'h'"></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-400 uppercase tracking-wider">End Time</p>
                            <p class="font-semibold text-gray-800" x-text="endTimeDisplay"></p>
                        </div>
                    </div>

                    {{-- Fasting Stage --}}
                    <div class="bg-indigo-50 rounded-lg p-4 mb-6">
                        <p class="text-sm font-medium text-indigo-700" x-text="currentStage.title"></p>
                        <p class="text-xs text-indigo-500 mt-1" x-text="currentStage.description"></p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-4 justify-center">
                        <button @click="endFast(false)" class="border border-gray-300 text-gray-600 font-medium py-2 px-6 rounded-lg hover:bg-gray-50 transition text-sm">
                            End Fast Early
                        </button>
                    </div>
                </div>

                {{-- What's Allowed --}}
                <div class="bg-white rounded-xl shadow-sm p-6 text-left">
                    <h3 class="font-semibold text-gray-800 mb-3">During Your Fast</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-medium text-emerald-600 uppercase tracking-wider mb-2">Allowed</p>
                            <ul class="space-y-1 text-sm text-gray-600">
                                <li>Water (still or sparkling)</li>
                                <li>Black coffee (no sugar/cream)</li>
                                <li>Plain tea</li>
                                <li>Salt / electrolytes</li>
                            </ul>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-red-600 uppercase tracking-wider mb-2">Avoid</p>
                            <ul class="space-y-1 text-sm text-gray-600">
                                <li>Any calories</li>
                                <li>Sugar-free drinks (may spike insulin)</li>
                                <li>Gum (can trigger hunger)</li>
                                <li>Broth (contains calories)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Completed --}}
            <div x-show="isComplete" class="text-center">
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="text-6xl mb-4">&#127881;</div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Fast Complete!</h2>
                    <p class="text-gray-500 mb-4" x-text="'You fasted for ' + completedDuration + '.'"></p>

                    <div class="bg-emerald-50 rounded-lg p-4 mb-6 inline-block">
                        <p class="text-emerald-700 font-semibold" x-text="activePlanName + ' — ' + goalHours + ' hours'"></p>
                    </div>

                    <div class="flex gap-4 justify-center">
                        <button @click="reset()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition">
                            Start Another Fast
                        </button>
                        <a href="{{ route('fasting.index') }}" class="border border-gray-300 text-gray-600 font-medium py-3 px-8 rounded-lg hover:bg-gray-50 transition">
                            Back to Plans
                        </a>
                    </div>
                </div>
            </div>

            {{-- History --}}
            <div x-show="history.length > 0" class="mt-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-800">Recent Fasts</h3>
                        <button @click="clearHistory()" class="text-xs text-gray-400 hover:text-red-500 transition">Clear</button>
                    </div>
                    <div class="space-y-2">
                        <template x-for="(entry, i) in history.slice().reverse().slice(0, 10)" :key="i">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-700" x-text="entry.plan"></p>
                                    <p class="text-xs text-gray-400" x-text="new Date(entry.startTime).toLocaleDateString()"></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold" :class="entry.completed ? 'text-emerald-600' : 'text-amber-600'" x-text="entry.duration"></p>
                                    <p class="text-xs" :class="entry.completed ? 'text-emerald-400' : 'text-amber-400'" x-text="entry.completed ? 'Completed' : 'Ended early'"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
    function fastingTimer() {
        return {
            plans: [
                { id: '16-8', name: '16:8', label: '16h fast / 8h eat', hours: 16 },
                { id: '18-6', name: '18:6', label: '18h fast / 6h eat', hours: 18 },
                { id: '20-4', name: '20:4', label: '20h fast / 4h eat', hours: 20 },
                { id: 'omad', name: 'OMAD', label: '23h fast / 1h eat', hours: 23 },
                { id: 'eat-stop-eat', name: 'Eat-Stop-Eat', label: '24h complete fast', hours: 24 },
                { id: 'custom', name: 'Custom', label: 'Set your own duration', hours: 0 },
            ],
            selectedPlan: null,
            customHours: 16,
            startTime: null,
            endTime: null,
            goalHours: 0,
            activePlanName: '',
            isActive: false,
            isComplete: false,
            completedDuration: '',
            now: Date.now(),
            ticker: null,
            history: [],

            stages: [
                { hours: 0, title: 'Fasting begins', description: 'Your body begins using food from your last meal.' },
                { hours: 4, title: 'Blood sugar stabilizing', description: 'Insulin levels start to drop. Your body shifts from using glucose to fat for energy.' },
                { hours: 8, title: 'Fat burning begins', description: 'Liver glycogen is being depleted. Fat oxidation is increasing.' },
                { hours: 12, title: 'Ketosis starting', description: 'Your body is producing ketones from fat. Growth hormone levels begin to rise.' },
                { hours: 16, title: 'Autophagy activating', description: 'Cellular cleanup is underway. Damaged proteins and organelles are being recycled.' },
                { hours: 18, title: 'Deep autophagy', description: 'Peak fat burning and cellular repair. Growth hormone has increased significantly.' },
                { hours: 24, title: 'Extended fast', description: 'Immune system regeneration begins. Inflammation markers are decreasing.' },
            ],

            init() {
                this.history = JSON.parse(localStorage.getItem('fasting_history') || '[]');

                // Restore active fast
                const saved = localStorage.getItem('fasting_active');
                if (saved) {
                    const data = JSON.parse(saved);
                    this.startTime = data.startTime;
                    this.endTime = data.endTime;
                    this.goalHours = data.goalHours;
                    this.activePlanName = data.planName;

                    if (Date.now() >= this.endTime) {
                        this.isComplete = true;
                        this.completedDuration = this.formatDuration(this.endTime - this.startTime);
                        this.addHistory(true);
                        localStorage.removeItem('fasting_active');
                    } else {
                        this.isActive = true;
                        this.startTicker();
                    }
                }
            },

            startFast() {
                if (!this.selectedPlan) return;
                const hours = this.selectedPlan.id === 'custom' ? this.customHours : this.selectedPlan.hours;
                this.goalHours = hours;
                this.activePlanName = this.selectedPlan.name;
                this.startTime = Date.now();
                this.endTime = this.startTime + (hours * 60 * 60 * 1000);
                this.isActive = true;
                this.isComplete = false;

                localStorage.setItem('fasting_active', JSON.stringify({
                    startTime: this.startTime,
                    endTime: this.endTime,
                    goalHours: this.goalHours,
                    planName: this.activePlanName,
                }));

                this.startTicker();
            },

            startTicker() {
                this.now = Date.now();
                this.ticker = setInterval(() => {
                    this.now = Date.now();
                    if (this.now >= this.endTime) {
                        this.endFast(true);
                    }
                }, 1000);
            },

            endFast(completed) {
                clearInterval(this.ticker);
                this.isActive = false;
                this.isComplete = true;
                const actualEnd = completed ? this.endTime : Date.now();
                this.completedDuration = this.formatDuration(actualEnd - this.startTime);
                this.addHistory(completed);
                localStorage.removeItem('fasting_active');
            },

            reset() {
                this.isActive = false;
                this.isComplete = false;
                this.selectedPlan = null;
                this.startTime = null;
                this.endTime = null;
                clearInterval(this.ticker);
            },

            addHistory(completed) {
                const actualEnd = completed ? this.endTime : Date.now();
                this.history.push({
                    plan: this.activePlanName,
                    startTime: this.startTime,
                    endTime: actualEnd,
                    goalHours: this.goalHours,
                    duration: this.formatDuration(actualEnd - this.startTime),
                    completed: completed,
                });
                localStorage.setItem('fasting_history', JSON.stringify(this.history));
            },

            clearHistory() {
                if (!confirm('Clear all fasting history?')) return;
                this.history = [];
                localStorage.removeItem('fasting_history');
            },

            get progress() {
                if (!this.startTime || !this.endTime) return 0;
                const total = this.endTime - this.startTime;
                const elapsed = this.now - this.startTime;
                return Math.min(1, Math.max(0, elapsed / total));
            },

            get timeDisplay() {
                if (!this.endTime) return '--:--:--';
                const remaining = Math.max(0, this.endTime - this.now);
                return this.formatTime(remaining);
            },

            get elapsedDisplay() {
                if (!this.startTime) return '--:--';
                const elapsed = this.now - this.startTime;
                const hours = Math.floor(elapsed / 3600000);
                const mins = Math.floor((elapsed % 3600000) / 60000);
                return hours + 'h ' + mins + 'm';
            },

            get endTimeDisplay() {
                if (!this.endTime) return '--:--';
                return new Date(this.endTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            },

            get currentStage() {
                if (!this.startTime) return this.stages[0];
                const hoursElapsed = (this.now - this.startTime) / 3600000;
                let stage = this.stages[0];
                for (const s of this.stages) {
                    if (hoursElapsed >= s.hours) stage = s;
                }
                return stage;
            },

            formatTime(ms) {
                const totalSeconds = Math.floor(ms / 1000);
                const h = Math.floor(totalSeconds / 3600);
                const m = Math.floor((totalSeconds % 3600) / 60);
                const s = totalSeconds % 60;
                return String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
            },

            formatDuration(ms) {
                const hours = Math.floor(ms / 3600000);
                const mins = Math.floor((ms % 3600000) / 60000);
                if (hours === 0) return mins + ' minutes';
                return hours + 'h ' + mins + 'm';
            },
        };
    }
    </script>
    @endpush
</x-app-layout>
