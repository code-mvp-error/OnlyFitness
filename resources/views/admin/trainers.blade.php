<x-admin-layout>
    @section('title', 'Trainers')

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6 text-sm">{{ session('success') }}</div>
    @endif

    <div x-data="{
        addOpen: false, editOpen: false, deleteId: null,
        edit: { id: null, name: '', specialty: '', bio: '', photo: '', certifications: '' },
        setEdit(t) { this.edit = { ...t }; this.editOpen = true; }
    }">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($trainers as $trainer)
                <div class="bg-brand-gray rounded-xl border border-white/5 overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ $trainer->photo ?? 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?w=400' }}"
                             alt="{{ $trainer->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             loading="lazy">
                        <div class="absolute top-3 right-3 flex gap-2">
                            <button @click="setEdit({ id: {{ $trainer->id }}, name: '{{ addslashes($trainer->name) }}', specialty: '{{ addslashes($trainer->specialty) }}', bio: '{{ addslashes($trainer->bio) }}', photo: '{{ $trainer->photo }}', certifications: '{{ $trainer->certifications ? implode(', ', $trainer->certifications) : '' }}' })"
                                    class="w-8 h-8 bg-brand-black/60 backdrop-blur-sm rounded-lg flex items-center justify-center text-brand-yellow hover:bg-brand-yellow/40 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                            <button @click="deleteId = {{ $trainer->id }}" class="w-8 h-8 bg-brand-black/60 backdrop-blur-sm rounded-lg flex items-center justify-center text-red-400 hover:bg-red-500/40 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-white font-heading font-bold text-lg">{{ $trainer->name }}</h3>
                        <p class="text-brand-yellow text-sm mt-1">{{ $trainer->specialty }}</p>
                        <div class="flex justify-between mt-4 border-t border-white/10 pt-4">
                            <div class="text-center">
                                <p class="text-white font-bold">{{ $trainer->bookings_count }}</p>
                                <p class="text-gray-500 text-xs uppercase tracking-wider mt-0.5">Sessions</p>
                            </div>
                            <div class="text-center">
                                <p class="text-white font-bold">4.9</p>
                                <p class="text-gray-500 text-xs uppercase tracking-wider mt-0.5">Rating</p>
                            </div>
                            <div class="text-center">
                                <p class="text-white font-bold">{{ \App\Models\Booking::where('trainer_id', $trainer->id)->distinct('user_id')->count('user_id') }}</p>
                                <p class="text-gray-500 text-xs uppercase tracking-wider mt-0.5">Clients</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">No trainers found.</div>
            @endforelse
        </div>

        {{-- Add FAB --}}
        <button @click="addOpen = true" class="fixed bottom-8 right-8 w-14 h-14 bg-brand-yellow rounded-full flex items-center justify-center text-brand-black shadow-lg hover:scale-110 transition-all z-30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        </button>

        {{-- Add Modal --}}
        <div x-show="addOpen" x-cloak @keydown.escape.window="addOpen = false" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="addOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="addOpen = false" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="addOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-lg bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8">
                <button @click="addOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <h3 class="font-heading font-bold text-white text-lg mb-6">Add Trainer</h3>
                <form method="POST" action="{{ route('admin.trainers.store') }}" class="space-y-4">
                    @csrf
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Name</label><input type="text" name="name" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Specialty</label><input type="text" name="specialty" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Bio</label><textarea name="bio" rows="3" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition resize-vertical"></textarea></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Photo URL</label><input type="url" name="photo" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition" placeholder="https://..."></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Certifications (comma separated)</label><input type="text" name="certifications" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition" placeholder="CPT, NSCA, ACSM"></div>
                    <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">Add Trainer</button>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div x-show="editOpen" x-cloak @keydown.escape.window="editOpen = false" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="editOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="editOpen = false" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="editOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-lg bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8">
                <button @click="editOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <h3 class="font-heading font-bold text-white text-lg mb-6">Edit Trainer</h3>
                <form method="POST" x-bind:action="`{{ url('admin/trainers') }}/${edit.id}`" class="space-y-4">
                    @csrf @method('PUT')
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Name</label><input type="text" name="name" x-model="edit.name" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Specialty</label><input type="text" name="specialty" x-model="edit.specialty" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Bio</label><textarea name="bio" rows="3" x-model="edit.bio" required class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition resize-vertical"></textarea></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Photo URL</label><input type="url" name="photo" x-model="edit.photo" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <div><label class="text-gray-300 text-sm font-medium mb-2 block">Certifications (comma separated)</label><input type="text" name="certifications" x-model="edit.certifications" class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition"></div>
                    <button type="submit" class="w-full bg-brand-yellow text-brand-black rounded-xl py-3 font-bold hover:bg-brand-gold transition">Update Trainer</button>
                </form>
            </div>
        </div>

        {{-- Delete Confirmation --}}
        <div x-show="deleteId" x-cloak @keydown.escape.window="deleteId = null" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="deleteId = null" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-brand-gray rounded-2xl p-6 border border-white/10 max-w-sm w-full z-10 text-center">
                <p class="text-white font-bold text-lg mb-2">Delete Trainer?</p>
                <p class="text-gray-400 text-sm mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="deleteId = null" class="px-6 py-2.5 rounded-xl border border-white/10 text-gray-400 hover:text-white transition font-medium">Cancel</button>
                    <form method="POST" x-bind:action="`{{ url('admin/trainers') }}/${deleteId}`">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-red-500 text-white font-medium hover:bg-red-600 transition">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
