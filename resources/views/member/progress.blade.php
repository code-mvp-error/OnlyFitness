<x-member-layout>
    <x-slot:title>My Progress</x-slot:title>

    {{-- Weight log form --}}
    <div class="bg-brand-gray rounded-2xl p-6 border border-white/5 mb-8">
        <h3 class="text-white font-heading text-lg font-bold uppercase mb-4">Log Weight</h3>
        <form method="POST" action="{{ route('member.progress.store') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
            @csrf
            <div>
                <label for="date" class="text-gray-300 text-sm font-medium mb-2 block">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                <x-input-error :messages="$errors->get('date')" class="mt-1" />
            </div>
            <div>
                <label for="weight" class="text-gray-300 text-sm font-medium mb-2 block">Weight (lbs)</label>
                <input type="number" step="0.1" id="weight" name="weight" value="{{ old('weight') }}" required placeholder="185"
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                <x-input-error :messages="$errors->get('weight')" class="mt-1" />
            </div>
            <div>
                <label for="body_fat" class="text-gray-300 text-sm font-medium mb-2 block">Body Fat %</label>
                <input type="number" step="0.1" id="body_fat" name="body_fat" value="{{ old('body_fat') }}" placeholder="15"
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                <x-input-error :messages="$errors->get('body_fat')" class="mt-1" />
            </div>
            <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">
                Log Entry
            </button>
        </form>
    </div>

    {{-- Chart --}}
    @if($chartData->count() > 1)
        @php
            $minWeight = $chartData->min('weight');
            $maxWeight = $chartData->max('weight');
            $range = max($maxWeight - $minWeight, 1);
            $padding = $range * 0.15;
            $chartMin = max($minWeight - $padding, 0);
            $chartMax = $maxWeight + $padding;
            $chartRange = max($chartMax - $chartMin, 1);
        @endphp
        <div class="bg-brand-gray rounded-2xl p-6 border border-white/5 mb-8">
            <h3 class="text-white font-heading text-lg font-bold uppercase mb-4">Weight Trend</h3>
            <div class="relative h-64 bg-brand-black rounded-xl overflow-hidden">
                {{-- Grid lines --}}
                @for($i = 0; $i <= 4; $i++)
                    @php $y = ($i / 4) * 100; @endphp
                    <div class="absolute left-0 right-0 border-t border-white/5" style="top: {{ $y }}%"></div>
                @endfor

                {{-- Data points and lines --}}
                @php $pointCount = $chartData->count(); @endphp
                @foreach($chartData as $i => $point)
                    @php
                        $x = ($pointCount > 1) ? ($i / ($pointCount - 1)) * 100 : 50;
                        $y = (($chartMax - $point->weight) / $chartRange) * 100;
                        $y = max(5, min(95, $y));
                    @endphp
                    {{-- Connecting line --}}
                    @if($i > 0)
                        @php
                            $prev = $chartData[$i - 1];
                            $px = (($i - 1) / ($pointCount - 1)) * 100;
                            $py = (($chartMax - $prev->weight) / $chartRange) * 100;
                            $py = max(5, min(95, $py));
                        @endphp
                        <div class="absolute h-0.5 bg-brand-yellow/60"
                             style="left: {{ $px }}%; top: {{ $py }}%; width: {{ $x - $px }}%; transform-origin: left center; transform: rotate({{ atan2($y - $py, 1) }}deg)"></div>
                    @endif
                    {{-- Point --}}
                    <div class="absolute w-3 h-3 bg-brand-yellow rounded-full -translate-x-1/2 -translate-y-1/2 z-10 shadow-lg"
                         style="left: {{ $x }}%; top: {{ $y }}%"
                         x-data
                         @mouseenter="$el.style.transform='scale(1.5)'; $el.style.cursor='pointer'"
                         @mouseleave="$el.style.transform=''">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-brand-black text-brand-yellow text-xs px-2 py-1 rounded whitespace-nowrap opacity-0 hover:opacity-100 transition"
                             style="display: none;"
                             x-init="() => { $el.addEventListener('mouseenter', () => $el.previousElementSibling.style.display = 'block') }">
                            {{ $point->weight }} lbs
                        </div>
                    </div>
                @endforeach

                {{-- Y-axis labels --}}
                <div class="absolute left-2 top-0 h-full flex flex-col justify-between text-gray-500 text-xs py-2">
                    <span>{{ number_format($chartMax, 1) }}</span>
                    <span>{{ number_format($chartMin + $chartRange * 0.5, 1) }}</span>
                    <span>{{ number_format($chartMin, 1) }}</span>
                </div>
            </div>
        </div>
    @endif

    {{-- Goals section --}}
    <div class="bg-brand-gray rounded-2xl p-6 border border-white/5 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-white font-heading text-lg font-bold uppercase">Current Goal</h3>
            <button @click="$dispatch('open-modal', 'goal-modal')"
                    class="text-brand-yellow text-sm hover:underline">Update Goal</button>
        </div>
        <div class="flex items-center gap-6">
            <div class="relative w-24 h-24 shrink-0">
                <svg class="w-24 h-24 -rotate-90" viewBox="0 0 36 36">
                    <circle cx="18" cy="18" r="15.5" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2.5"/>
                    <circle cx="18" cy="18" r="15.5" fill="none" stroke="#E5C100" stroke-width="2.5"
                            stroke-dasharray="97.4" stroke-dashoffset="24.35" stroke-linecap="round"/>
                </svg>
                <span class="absolute inset-0 flex items-center justify-center text-white font-bold text-lg">75%</span>
            </div>
            <div>
                <p class="text-white font-bold text-lg capitalize">{{ str_replace('_', ' ', $user->goal ?? 'General Fitness') }}</p>
                <p class="text-gray-400 text-sm">Keep pushing! You're making great progress.</p>
            </div>
        </div>
    </div>

    {{-- Goal update modal --}}
    <div x-data="{ open: false }"
         x-show="open"
         x-cloak
         @open-modal.window="if ($event.detail === 'goal-modal') open = true"
         @keydown.escape.window="open = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false" class="absolute inset-0 bg-black/70"></div>
        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-brand-gray rounded-2xl p-6 border border-white/10 max-w-md w-full z-10">
            <h3 class="text-white font-heading text-lg font-bold uppercase mb-4">Update Your Goal</h3>
            <form method="POST" action="{{ route('member.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="goal" class="text-gray-300 text-sm font-medium mb-2 block">Fitness Goal</label>
                    <select id="goal" name="goal" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50">
                        <option value="lose_weight" {{ $user->goal === 'lose_weight' ? 'selected' : '' }}>Lose Weight</option>
                        <option value="build_muscle" {{ $user->goal === 'build_muscle' ? 'selected' : '' }}>Build Muscle</option>
                        <option value="improve_endurance" {{ $user->goal === 'improve_endurance' ? 'selected' : '' }}>Improve Endurance</option>
                        <option value="general_fitness" {{ $user->goal === 'general_fitness' ? 'selected' : '' }}>General Fitness</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <button type="button" @click="open = false" class="flex-1 px-4 py-3 rounded-xl border border-white/10 text-gray-400 hover:text-white transition font-medium">Cancel</button>
                    <button type="submit" class="flex-1 bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">Save Goal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- History table --}}
    <div class="bg-brand-gray rounded-2xl p-6 border border-white/5">
        <h3 class="text-white font-heading text-lg font-bold uppercase mb-4">History</h3>
        @if($logs->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-white/10 text-gray-400 text-sm uppercase tracking-wider">
                            <th class="pb-3 font-medium">Date</th>
                            <th class="pb-3 font-medium">Weight</th>
                            <th class="pb-3 font-medium">Body Fat</th>
                            <th class="pb-3 font-medium">Change</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($logs as $i => $log)
                            @php
                                $prevWeight = $logs[$i + 1] ?? null;
                                $change = $prevWeight ? $log->weight - $prevWeight->weight : 0;
                            @endphp
                            <tr class="text-white">
                                <td class="py-3 text-sm">{{ $log->date->format('M d, Y') }}</td>
                                <td class="py-3 font-medium">{{ number_format($log->weight, 1) }} lbs</td>
                                <td class="py-3 text-gray-400">{{ $log->body_fat ? number_format($log->body_fat, 1) . '%' : '—' }}</td>
                                <td class="py-3">
                                    @if($change != 0)
                                        <span class="{{ $change < 0 ? 'text-green-400' : 'text-red-400' }} text-sm font-medium">
                                            {{ $change > 0 ? '+' : '' }}{{ number_format($change, 1) }} lbs
                                        </span>
                                    @else
                                        <span class="text-gray-500 text-sm">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-400 text-center py-6">No progress entries yet. Log your first weight above!</p>
        @endif
    </div>
</x-member-layout>
