<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Plan;
use App\Models\ProgressLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function dashboard(): View
    {
        $user = auth()->user()->load('plan');

        $workoutsThisMonth = Booking::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->count();

        $trainerSessions = Booking::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $latestWeight = ProgressLog::where('user_id', $user->id)->latest('date')->first();

        $goalProgress = 75;

        $upcomingBookings = Booking::with(['program', 'trainer'])
            ->where('user_id', $user->id)
            ->where('date', '>=', now()->toDateString())
            ->where('status', 'confirmed')
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get();

        $memberSince = $user->created_at;

        $allTimeBookings = Booking::where('user_id', $user->id)->count();
        $currentStreak = $allTimeBookings;

        $stats = [
            'workouts' => $workoutsThisMonth,
            'sessions' => $trainerSessions,
            'weight' => $latestWeight?->weight ?? '—',
            'goal' => $goalProgress,
        ];

        return view('dashboard', compact('user', 'stats', 'upcomingBookings', 'memberSince', 'currentStreak'));
    }

    public function bookings(): View
    {
        $user = auth()->user();

        $bookings = Booking::with(['program', 'trainer'])
            ->where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        $bookingsByDate = $bookings->groupBy(fn($b) => $b->date);

        $calendarDays = [];
        for ($d = 1; $d <= now()->daysInMonth; $d++) {
            $date = now()->startOfMonth()->addDays($d - 1);
            $calendarDays[] = [
                'day' => $d,
                'date' => $date->format('Y-m-d'),
                'dayOfWeek' => $date->dayOfWeek,
                'hasBooking' => $bookingsByDate->has($date->format('Y-m-d')),
            ];
        }

        return view('member.bookings', compact('bookings', 'bookingsByDate', 'calendarDays'));
    }

    public function progress(): View
    {
        $user = auth()->user();
        $logs = ProgressLog::where('user_id', $user->id)->orderBy('date', 'desc')->get();

        $chartData = $logs->sortBy('date')->values();

        return view('member.progress', compact('logs', 'chartData', 'user'));
    }

    public function storeProgress(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'min:50', 'max:500'],
            'body_fat' => ['nullable', 'numeric', 'min:1', 'max:60'],
        ]);

        auth()->user()->progressLogs()->create($validated);

        return back()->with('status', 'progress-logged');
    }

    public function profile(): View
    {
        $user = auth()->user()->load('plan');
        $plans = Plan::all();
        return view('member.profile', compact('user', 'plans'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'regex:/^[\d\s\-\(\)\+]+$/'],
            'goal' => ['required', 'in:lose_weight,build_muscle,improve_endurance,general_fitness'],
            'plan_id' => ['nullable', 'exists:plans,id'],
        ]);

        $user->update($validated);

        return back()->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', \Illuminate\Validation\Rules\Password::defaults(), 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function cancelMembership(Request $request): RedirectResponse
    {
        $user = auth()->user();
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();

        return redirect('/');
    }
}
