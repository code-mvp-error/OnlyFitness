<x-member-layout>
    <x-slot:title>Profile Settings</x-slot:title>

    @if(session('status') === 'profile-updated')
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6 text-sm">Profile updated successfully.</div>
    @endif
    @if(session('status') === 'password-updated')
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6 text-sm">Password changed successfully.</div>
    @endif

    {{-- Personal info --}}
    <div class="bg-brand-gray rounded-2xl p-6 border border-white/5 mb-6">
        <h3 class="text-white font-heading text-lg font-bold uppercase mb-4">Personal Information</h3>
        <form method="POST" action="{{ route('member.profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="text-gray-300 text-sm font-medium mb-2 block">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
            </div>
            <div>
                <label for="email" class="text-gray-300 text-sm font-medium mb-2 block">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
            </div>
            <div>
                <label for="phone" class="text-gray-300 text-sm font-medium mb-2 block">Phone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
            </div>
            <div>
                <label for="goal" class="text-gray-300 text-sm font-medium mb-2 block">Fitness Goal</label>
                <select id="goal" name="goal" required
                        class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50">
                    <option value="lose_weight" {{ $user->goal === 'lose_weight' ? 'selected' : '' }}>Lose Weight</option>
                    <option value="build_muscle" {{ $user->goal === 'build_muscle' ? 'selected' : '' }}>Build Muscle</option>
                    <option value="improve_endurance" {{ $user->goal === 'improve_endurance' ? 'selected' : '' }}>Improve Endurance</option>
                    <option value="general_fitness" {{ $user->goal === 'general_fitness' ? 'selected' : '' }}>General Fitness</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="bg-brand-yellow text-brand-black rounded-xl px-8 py-3 font-bold hover:bg-brand-gold transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Plan management --}}
    <div class="bg-brand-gray rounded-2xl p-6 border border-white/5 mb-6">
        <h3 class="text-white font-heading text-lg font-bold uppercase mb-4">Plan Management</h3>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-white font-bold text-lg">{{ $user->plan?->name ?? 'No Plan' }}</p>
                <p class="text-gray-400 text-sm">{{ $user->plan ? 'MAD ' . number_format($user->plan->price_monthly, 0) . '/month' : 'Free member' }}</p>
            </div>
            @if($user->plan)
                <div class="flex gap-3">
                    @foreach($plans as $plan)
                        @if($plan->id !== $user->plan_id)
                            <form method="POST" action="{{ route('member.profile.update') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $user->name }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <input type="hidden" name="phone" value="{{ $user->phone }}">
                                <input type="hidden" name="goal" value="{{ $user->goal }}">
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <button type="submit" class="px-4 py-2 rounded-xl border border-brand-yellow text-brand-yellow text-sm font-medium hover:bg-brand-yellow hover:text-brand-black transition">
                                    {{ $plan->price_monthly > $user->plan->price_monthly ? 'Upgrade' : 'Downgrade' }} to {{ $plan->name }}
                                </button>
                            </form>
                        @endif
                    @endforeach
                </div>
            @else
                <a href="{{ route('pricing') }}" class="bg-brand-yellow text-brand-black rounded-xl px-6 py-3 font-bold hover:bg-brand-gold transition text-sm">
                    Choose a Plan
                </a>
            @endif
        </div>
    </div>

    {{-- Change password --}}
    <div class="bg-brand-gray rounded-2xl p-6 border border-white/5 mb-6">
        <h3 class="text-white font-heading text-lg font-bold uppercase mb-4">Change Password</h3>
        <form method="POST" action="{{ route('member.password.update') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            @method('PUT')
            <div>
                <label for="current_password" class="text-gray-300 text-sm font-medium mb-2 block">Current Password</label>
                <input type="password" id="current_password" name="current_password" required
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
            </div>
            <div>
                <label for="password" class="text-gray-300 text-sm font-medium mb-2 block">New Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
            </div>
            <div>
                <label for="password_confirmation" class="text-gray-300 text-sm font-medium mb-2 block">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full bg-brand-black border border-white/10 rounded-xl px-4 py-3 text-white focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition">
            </div>
            <div class="md:col-span-3">
                <button type="submit" class="bg-brand-yellow text-brand-black rounded-xl px-8 py-3 font-bold hover:bg-brand-gold transition">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    {{-- Danger zone --}}
    <div class="bg-brand-gray rounded-2xl p-6 border border-red-500/20 mb-6">
        <h3 class="text-red-400 font-heading text-lg font-bold uppercase mb-4">Danger Zone</h3>
        <p class="text-gray-400 text-sm mb-4">Once you cancel your membership, all your data will be permanently deleted.</p>
        <div x-data="{ confirmCancel: false }">
            <button @click="confirmCancel = true"
                    class="px-6 py-3 rounded-xl border border-red-500 text-red-400 font-medium hover:bg-red-500/10 transition text-sm">
                Cancel Membership
            </button>
            <div x-show="confirmCancel"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="mt-4 p-4 bg-red-500/10 rounded-xl border border-red-500/30">
                <p class="text-red-400 text-sm mb-3">Are you sure? This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="confirmCancel = false"
                            class="px-4 py-2 rounded-xl border border-white/10 text-gray-400 hover:text-white transition text-sm">
                        Keep My Account
                    </button>
                    <form method="POST" action="{{ route('member.cancel') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 rounded-xl bg-red-500 text-white font-medium hover:bg-red-600 transition text-sm">
                            Yes, Cancel My Membership
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-member-layout>
