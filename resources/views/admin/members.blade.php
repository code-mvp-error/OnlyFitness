<x-admin-layout>
    @section('title', 'Members')

    @php $goalLabels = ['lose_weight' => 'Lose Weight', 'build_muscle' => 'Build Muscle', 'improve_endurance' => 'Improve Endurance', 'general_fitness' => 'General Fitness']; @endphp

    <div x-data="{
        addOpen: false, editOpen: false, deleteId: null,
        edit: { id: null, name: '', email: '', phone: '', goal: '', plan_id: '', password: '' },
        setEdit(user) { this.edit = { ...user, password: '' }; this.editOpen = true; }
    }">
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6 text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl p-4 mb-6 text-sm">{{ session('error') }}</div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <form method="GET" class="flex flex-1 flex-col sm:flex-row gap-4">
                <input type="text" name="search" placeholder="Search members..." value="{{ request('search') }}"
                       class="bg-brand-black border border-white/10 rounded-lg px-4 py-2.5 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors text-sm w-full sm:w-64">
                <select name="plan" class="bg-brand-black border border-white/10 rounded-lg px-4 py-2.5 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors text-sm">
                    <option value="">All Plans</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ request('plan') == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-white/5 text-gray-400 px-4 py-2.5 rounded-lg text-sm hover:text-white transition">Filter</button>
            </form>
            <button @click="addOpen = true" class="bg-brand-yellow text-brand-black px-4 py-2.5 rounded-lg font-bold text-sm hover:bg-brand-gold transition hover:scale-[1.02] whitespace-nowrap">+ Add Member</button>
        </div>

        <div class="bg-brand-gray rounded-xl border border-white/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-500 text-xs uppercase tracking-wider border-b border-white/10">
                            <th class="px-6 py-4 text-left font-semibold">Name</th>
                            <th class="px-6 py-4 text-left font-semibold hidden md:table-cell">Email</th>
                            <th class="px-6 py-4 text-left font-semibold">Plan</th>
                            <th class="px-6 py-4 text-left font-semibold hidden lg:table-cell">Joined</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-brand-yellow/20 rounded-full flex items-center justify-center shrink-0">
                                            <span class="text-sm font-bold text-brand-yellow">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">{{ $user->name }}</p>
                                            <p class="text-gray-500 text-xs md:hidden">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-400 hidden md:table-cell">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @php $pn = $user->plan?->name ?? 'Basic'; @endphp
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                        {{ strtolower($pn) === 'basic' ? 'bg-gray-500/20 text-gray-400' : '' }}
                                        {{ strtolower($pn) === 'pro' ? 'bg-brand-yellow/20 text-brand-yellow' : '' }}
                                        {{ strtolower($pn) === 'elite' ? 'bg-yellow-600/20 text-yellow-500' : '' }}">
                                        {{ $pn }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 hidden lg:table-cell">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                        <span class="text-gray-400 text-xs">Active</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button @click="setEdit({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}', '{{ $user->goal }}', '{{ $user->plan_id }}')"
                                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-brand-yellow hover:bg-brand-yellow/20 transition"
                                                x-data
                                                x-init="$el.__setEdit = function() { setEdit({ id: {{ $user->id }}, name: '{{ addslashes($user->name) }}', email: '{{ $user->email }}', phone: '{{ $user->phone }}', goal: '{{ $user->goal }}', plan_id: '{{ $user->plan_id }}' }); }"
                                                @click="$el.__setEdit()">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        @if(!$user->is_admin)
                                            <button @click="deleteId = {{ $user->id }}" class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-red-400 hover:bg-red-500/20 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">No members found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($users->hasPages())
            <div class="mt-6 flex items-center justify-between">
                <p class="text-gray-500 text-sm">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} members</p>
                <div class="flex gap-2">
                    @if($users->onFirstPage())
                        <span class="px-3 py-1.5 rounded-lg bg-brand-gray text-gray-600 text-sm cursor-not-allowed">Prev</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-brand-gray text-gray-400 hover:text-white text-sm transition">Prev</a>
                    @endif
                    @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-sm transition {{ $page === $users->currentPage() ? 'bg-brand-yellow text-brand-black font-bold' : 'bg-brand-gray text-gray-400 hover:text-white' }}">{{ $page }}</a>
                    @endforeach
                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1.5 rounded-lg bg-brand-gray text-gray-400 hover:text-white text-sm transition">Next</a>
                    @else
                        <span class="px-3 py-1.5 rounded-lg bg-brand-gray text-gray-600 text-sm cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        @endif

        {{-- Add Modal --}}
        <div x-show="addOpen" x-cloak @keydown.escape.window="addOpen = false" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="addOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="addOpen = false" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="addOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-lg bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8">
                <button @click="addOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <h3 class="font-heading font-bold text-white text-lg mb-6">Add Member</h3>
                <form method="POST" action="{{ route('admin.members.store') }}" class="space-y-4">
                    @csrf
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Name</label><input type="text" name="name" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Email</label><input type="email" name="email" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Phone</label><input type="tel" name="phone" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Goal</label>
                        <select name="goal" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                            @foreach($goalLabels as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Plan</label>
                        <select name="plan_id" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                            <option value="">No Plan</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }} (MAD {{ number_format($plan->price_monthly, 0) }}/mo)</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Password</label><input type="password" name="password" required min="8" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">Create Member</button>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div x-show="editOpen" x-cloak @keydown.escape.window="editOpen = false" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="editOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="editOpen = false" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="editOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-lg bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8">
                <button @click="editOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <h3 class="font-heading font-bold text-white text-lg mb-6">Edit Member</h3>
                <form method="POST" action="{{ url('admin/members/0') }}" x-bind:action="`{{ url('admin/members') }}/${edit.id}`" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Name</label><input type="text" name="name" x-model="edit.name" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Email</label><input type="email" name="email" x-model="edit.email" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Phone</label><input type="tel" name="phone" x-model="edit.phone" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Goal</label>
                        <select name="goal" x-model="edit.goal" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                            @foreach($goalLabels as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Plan</label>
                        <select name="plan_id" x-model="edit.plan_id" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                            <option value="">No Plan</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }} (MAD {{ number_format($plan->price_monthly, 0) }}/mo)</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">New Password (leave blank to keep)</label><input type="password" name="password" x-model="edit.password" min="8" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">Update Member</button>
                </form>
            </div>
        </div>

        {{-- Delete Confirmation --}}
        <div x-show="deleteId" x-cloak @keydown.escape.window="deleteId = null" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="deleteId = null" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-brand-gray rounded-2xl p-6 border border-white/10 max-w-sm w-full z-10 text-center">
                <p class="text-white font-bold text-lg mb-2">Delete Member?</p>
                <p class="text-gray-400 text-sm mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="deleteId = null" class="px-6 py-2.5 rounded-xl border border-white/10 text-gray-400 hover:text-white transition font-medium">Cancel</button>
                    <form method="POST" x-bind:action="`{{ url('admin/members') }}/${deleteId}`">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-red-500 text-white font-medium hover:bg-red-600 transition">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
