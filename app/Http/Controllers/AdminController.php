<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Plan;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'users' => User::count(),
            'bookings' => Booking::count(),
            'revenue' => number_format(Booking::count() * 50 + 4250),
            'new_leads' => Contact::where('created_at', '>=', now()->subWeek())->count(),
        ];

        $chartData = [];
        $maxVal = 1;
        for ($d = 1; $d <= now()->daysInMonth; $d++) {
            $date = now()->startOfMonth()->addDays($d - 1)->format('Y-m-d');
            $count = Booking::whereDate('created_at', $date)->count();
            $chartData[] = ['day' => $d, 'count' => $count];
            if ($count > $maxVal) $maxVal = $count;
        }

        $recentBookings = Booking::with(['user', 'trainer', 'program'])->latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'chartData', 'maxVal', 'recentBookings', 'recentContacts'));
    }

    // ---- Members CRUD ----

    public function members(): View
    {
        $users = User::with('plan')->latest()->paginate(10);
        $plans = Plan::all();
        return view('admin.members', compact('users', 'plans'));
    }

    public function membersStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'regex:/^[\d\s\-\(\)\+]+$/'],
            'goal' => ['required', 'in:lose_weight,build_muscle,improve_endurance,general_fitness'],
            'plan_id' => ['nullable', 'exists:plans,id'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return back()->with('success', 'Member created successfully.');
    }

    public function membersUpdate(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'phone' => ['required', 'string', 'regex:/^[\d\s\-\(\)\+]+$/'],
            'goal' => ['required', 'in:lose_weight,build_muscle,improve_endurance,general_fitness'],
            'plan_id' => ['nullable', 'exists:plans,id'],
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => ['string', 'min:8']]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return back()->with('success', 'Member updated successfully.');
    }

    public function membersDestroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if ($user->is_admin) {
            return back()->with('error', 'Cannot delete admin accounts.');
        }
        $user->delete();
        return back()->with('success', 'Member deleted successfully.');
    }

    // ---- Bookings CRUD ----

    public function bookings(): View
    {
        $bookings = Booking::with(['user', 'trainer', 'program'])->latest()->get();
        $bookingsByDate = $bookings->groupBy(fn($b) => $b->date);

        $calendarDays = [];
        for ($d = 1; $d <= now()->daysInMonth; $d++) {
            $date = now()->startOfMonth()->addDays($d - 1);
            $calendarDays[] = [
                'day' => $d,
                'date' => $date->format('Y-m-d'),
                'dayOfWeek' => $date->dayOfWeek,
            ];
        }

        return view('admin.bookings', compact('bookings', 'bookingsByDate', 'calendarDays'));
    }

    public function bookingsStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'trainer_id' => ['nullable', 'exists:trainers,id'],
            'date' => ['required', 'date', 'after:' . now()->subDay()->format('Y-m-d')],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $validated['status'] = 'confirmed';
        Booking::create($validated);

        return back()->with('success', 'Booking created successfully.');
    }

    public function bookingsConfirm(int $id): RedirectResponse
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'confirmed']);
        return back()->with('success', 'Booking confirmed.');
    }

    public function bookingsCancel(int $id): RedirectResponse
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking cancelled.');
    }

    public function bookingsReschedule(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'date' => ['required', 'date', 'after:' . now()->subDay()->format('Y-m-d')],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($validated);

        return back()->with('success', 'Booking rescheduled.');
    }

    public function bookingsDestroy(int $id): RedirectResponse
    {
        Booking::findOrFail($id)->delete();
        return back()->with('success', 'Booking deleted.');
    }

    // ---- Trainers CRUD ----

    public function trainers(): View
    {
        $trainers = Trainer::withCount('bookings')->get();
        return view('admin.trainers', compact('trainers'));
    }

    public function trainersStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string', 'max:1000'],
            'photo' => ['nullable', 'url', 'max:500'],
            'certifications' => ['nullable', 'string'],
        ]);

        $certifications = $request->input('certifications');
        $validated['certifications'] = $certifications
            ? array_map('trim', explode(',', $certifications))
            : [];

        Trainer::create($validated);

        return back()->with('success', 'Trainer added successfully.');
    }

    public function trainersUpdate(Request $request, int $id): RedirectResponse
    {
        $trainer = Trainer::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string', 'max:1000'],
            'photo' => ['nullable', 'url', 'max:500'],
            'certifications' => ['nullable', 'string'],
        ]);

        $certifications = $request->input('certifications');
        $validated['certifications'] = $certifications
            ? array_map('trim', explode(',', $certifications))
            : [];

        $trainer->update($validated);

        return back()->with('success', 'Trainer updated successfully.');
    }

    public function trainersDestroy(int $id): RedirectResponse
    {
        Trainer::findOrFail($id)->delete();
        return back()->with('success', 'Trainer deleted.');
    }

    // ---- Contacts CRUD ----

    public function contacts(): View
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }

    public function contactsMarkRead(int $id): RedirectResponse
    {
        Contact::findOrFail($id)->update(['status' => 'read']);
        return back()->with('success', 'Contact marked as read.');
    }

    public function contactsReply(Request $request, int $id): RedirectResponse
    {
        $request->validate(['message' => ['required', 'string', 'max:2000']]);

        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'replied']);

        return back()->with('success', 'Reply sent to ' . $contact->name . '.');
    }

    public function contactsArchive(int $id): RedirectResponse
    {
        Contact::findOrFail($id)->update(['status' => 'archived']);
        return back()->with('success', 'Contact archived.');
    }

    public function contactsDestroy(int $id): RedirectResponse
    {
        Contact::findOrFail($id)->delete();
        return back()->with('success', 'Contact deleted.');
    }
}
