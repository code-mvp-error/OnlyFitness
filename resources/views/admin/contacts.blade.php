<x-admin-layout>
    @section('title', 'Contacts')

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6 text-sm">{{ session('success') }}</div>
    @endif

    <div x-data="{ replyId: null, replyMessage: '', viewId: null, deleteId: null }">
        <div class="bg-brand-gray rounded-xl border border-white/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-500 text-xs uppercase tracking-wider border-b border-white/10">
                            <th class="px-6 py-4 text-left font-semibold">Name</th>
                            <th class="px-6 py-4 text-left font-semibold hidden sm:table-cell">Email</th>
                            <th class="px-6 py-4 text-left font-semibold hidden md:table-cell">Goal</th>
                            <th class="px-6 py-4 text-left font-semibold hidden lg:table-cell">Plan</th>
                            <th class="px-6 py-4 text-left font-semibold hidden lg:table-cell">Date</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="px-6 py-4">
                                    <p class="text-white font-medium">{{ $contact->name }}</p>
                                    <p class="text-gray-500 text-xs sm:hidden">{{ $contact->email }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-400 hidden sm:table-cell">{{ $contact->email }}</td>
                                <td class="px-6 py-4 text-gray-400 hidden md:table-cell">{{ str_replace('_', ' ', ucfirst($contact->goal)) }}</td>
                                <td class="px-6 py-4 hidden lg:table-cell">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                        {{ $contact->plan === 'basic' ? 'bg-gray-500/20 text-gray-400' : '' }}
                                        {{ $contact->plan === 'pro' ? 'bg-brand-yellow/20 text-brand-yellow' : '' }}
                                        {{ $contact->plan === 'elite' ? 'bg-yellow-600/20 text-yellow-500' : '' }}">
                                        {{ ucfirst($contact->plan) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 hidden lg:table-cell">{{ $contact->created_at->format('M d') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                        {{ $contact->status === 'unread' ? 'bg-brand-yellow/10 text-brand-yellow' : '' }}
                                        {{ $contact->status === 'read' ? 'bg-blue-500/10 text-blue-400' : '' }}
                                        {{ $contact->status === 'replied' ? 'bg-green-500/10 text-green-400' : '' }}
                                        {{ $contact->status === 'archived' ? 'bg-gray-500/20 text-gray-400' : '' }}">
                                        {{ ucfirst($contact->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button @click="viewId = {{ $contact->id }}"
                                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:text-brand-yellow hover:bg-brand-yellow/20 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                        @if($contact->status === 'unread')
                                            <form method="POST" action="{{ route('admin.contacts.read', $contact->id) }}" class="inline">
                                                @csrf @method('PUT')
                                                <button class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-blue-400 hover:bg-blue-500/20 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                        <button @click="replyId = {{ $contact->id }}; replyMessage = ''"
                                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:text-brand-yellow hover:bg-brand-yellow/20 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                        </button>
                                        @if($contact->status !== 'archived')
                                            <form method="POST" action="{{ route('admin.contacts.archive', $contact->id) }}" class="inline">
                                                @csrf @method('PUT')
                                                <button class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:text-brand-yellow hover:bg-brand-yellow/20 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                        <button @click="deleteId = {{ $contact->id }}" class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:text-red-400 hover:bg-red-500/20 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-12 text-center text-gray-500">No contacts yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- View Modal --}}
        <div x-show="viewId !== null" x-cloak @keydown.escape.window="viewId = null" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="viewId !== null" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="viewId = null" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="viewId !== null" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-2xl bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8 max-h-[80vh] overflow-y-auto">
                <button @click="viewId = null" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                @foreach($contacts as $contact)
                    <div x-show="viewId === {{ $contact->id }}" x-cloak>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-brand-yellow/20 rounded-full flex items-center justify-center">
                                <span class="text-lg font-bold text-brand-yellow">{{ substr($contact->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h3 class="text-white font-heading font-bold text-lg">{{ $contact->name }}</h3>
                                <p class="text-gray-400 text-sm">{{ $contact->email }} · {{ $contact->phone }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3 mb-4">
                            <span class="px-3 py-1 bg-brand-yellow/10 text-brand-yellow rounded-full text-xs font-bold">{{ str_replace('_', ' ', ucfirst($contact->goal)) }}</span>
                            <span class="px-3 py-1 bg-brand-yellow/10 text-brand-yellow rounded-full text-xs font-bold">{{ ucfirst($contact->plan) }}</span>
                        </div>
                        <div class="bg-brand-black rounded-lg p-4 text-gray-300 leading-relaxed">{{ $contact->message }}</div>
                        <p class="text-gray-500 text-xs mt-4">{{ $contact->created_at->format('F j, Y g:i A') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Reply Modal --}}
        <div x-show="replyId !== null" x-cloak @keydown.escape.window="replyId = null" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="replyId !== null" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="replyId = null" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="replyId !== null" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-2xl bg-brand-gray rounded-2xl border border-white/10 shadow-2xl z-10 p-8">
                <button @click="replyId = null" class="absolute top-4 right-4 text-gray-400 hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <h3 class="font-heading font-bold text-white text-lg mb-4">Reply to Contact</h3>
                @foreach($contacts as $contact)
                    <div x-show="replyId === {{ $contact->id }}" x-cloak>
                        <div class="bg-brand-black rounded-lg p-4 text-gray-300 text-sm mb-4">
                            <p class="text-brand-yellow font-semibold mb-1">{{ $contact->name }} wrote:</p>
                            {{ $contact->message }}
                        </div>
                        <form method="POST" action="{{ route('admin.contacts.reply', $contact->id) }}">
                            @csrf
                            <textarea name="message" rows="5" x-model="replyMessage" required
                                      placeholder="Type your reply..."
                                      class="w-full bg-brand-black border border-white/10 rounded-xl px-6 py-4 text-white placeholder-gray-500 focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-colors resize-vertical"></textarea>
                            <div class="flex justify-end gap-3 mt-4">
                                <button type="button" @click="replyId = null" class="px-6 py-2.5 border border-white/10 text-gray-400 rounded-lg text-sm hover:text-white transition">Cancel</button>
                                <button type="submit" class="px-6 py-2.5 bg-brand-yellow text-brand-black rounded-lg text-sm font-bold hover:bg-brand-gold transition">Send Reply</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Delete Confirmation --}}
        <div x-show="deleteId" x-cloak @keydown.escape.window="deleteId = null" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="deleteId = null" class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
            <div x-show="deleteId" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-brand-gray rounded-2xl p-6 border border-white/10 max-w-sm w-full z-10 text-center">
                <p class="text-white font-bold text-lg mb-2">Delete Contact?</p>
                <p class="text-gray-400 text-sm mb-6">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="deleteId = null" class="px-6 py-2.5 rounded-xl border border-white/10 text-gray-400 hover:text-white transition font-medium">Cancel</button>
                    <form method="POST" x-bind:action="`{{ url('admin/contacts') }}/${deleteId}`">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-red-500 text-white font-medium hover:bg-red-600 transition">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
