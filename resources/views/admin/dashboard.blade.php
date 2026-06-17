<x-admin-layout>
    @section('title', 'Dashboard')

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Total Members</p>
                    <p class="font-heading text-3xl font-bold text-white mt-1">{{ $stats['users'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-brand-yellow/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
            </div>
            <p class="text-green-400 text-xs mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                +12% from last month
            </p>
        </div>
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Active Bookings</p>
                    <p class="font-heading text-3xl font-bold text-white mt-1">{{ $stats['bookings'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-brand-yellow/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                </div>
            </div>
            <p class="text-green-400 text-xs mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                +5% from last month
            </p>
        </div>
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Monthly Revenue</p>
                    <p class="font-heading text-3xl font-bold text-white mt-1">${{ $stats['revenue'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-brand-yellow/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-green-400 text-xs mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                +8% from last month
            </p>
        </div>
        <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold">New Leads</p>
                    <p class="font-heading text-3xl font-bold text-white mt-1">{{ $stats['new_leads'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-brand-yellow/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                </div>
            </div>
            <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                -2% from last week
            </p>
        </div>
    </div>

    {{-- Chart --}}
    <div class="bg-brand-gray rounded-xl p-6 border border-white/5 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-heading font-bold text-white uppercase text-sm tracking-wider">Bookings This Month</h2>
            <span class="text-gray-500 text-xs">{{ now()->format('F Y') }}</span>
        </div>
        <div class="flex items-end gap-[3px] h-32">
            @foreach($chartData as $item)
                <div class="flex-1 relative group">
                    <div class="w-full bg-brand-yellow/20 rounded-t-sm hover:bg-brand-yellow transition-all duration-200 cursor-pointer"
                         style="height: {{ max(4, ($item['count'] / max($maxVal, 1)) * 100) }}%">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-brand-yellow text-brand-black text-xs font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap pointer-events-none">
                            {{ $item['count'] }} bookings
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-between mt-2">
            @foreach($chartData as $i => $item)
                @if($i % 5 === 0 || $i === count($chartData) - 1)
                    <span class="text-gray-500 text-xs">{{ $item['day'] }}</span>
                @endif
            @endforeach
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-brand-gray rounded-xl p-6 border border-white/5">
        <h2 class="font-heading font-bold text-white uppercase text-sm tracking-wider mb-6">Recent Activity</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-500 text-xs uppercase tracking-wider border-b border-white/10">
                        <th class="pb-3 pr-4 text-left font-semibold">User</th>
                        <th class="pb-3 pr-4 text-left font-semibold">Action</th>
                        <th class="pb-3 pr-4 text-left font-semibold hidden md:table-cell">Time</th>
                        <th class="pb-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                        <tr class="border-b border-white/5">
                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-brand-yellow/20 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold text-brand-yellow">{{ substr($booking->user->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-white font-medium">{{ $booking->user->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 pr-4 text-gray-400">Booked "{{ $booking->program->name }}"</td>
                            <td class="py-3 pr-4 text-gray-500 hidden md:table-cell">{{ $booking->created_at->diffForHumans() }}</td>
                            <td class="py-3">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                    {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-400' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-brand-yellow/10 text-brand-yellow' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-500/10 text-red-400' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($recentContacts as $contact)
                        <tr class="border-b border-white/5">
                            <td class="py-3 pr-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-brand-yellow/20 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold text-brand-yellow">{{ substr($contact->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-white font-medium">{{ $contact->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 pr-4 text-gray-400">Sent a message</td>
                            <td class="py-3 pr-4 text-gray-500 hidden md:table-cell">{{ $contact->created_at->diffForHumans() }}</td>
                            <td class="py-3">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                    {{ $contact->status === 'unread' ? 'bg-brand-yellow/10 text-brand-yellow' : 'bg-green-500/10 text-green-400' }}">
                                    {{ ucfirst($contact->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    @if($recentBookings->isEmpty() && $recentContacts->isEmpty())
                        <tr><td colspan="4" class="py-8 text-center text-gray-500">No activity yet.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
