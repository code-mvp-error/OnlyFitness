<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'trainer_id' => 'required|exists:trainers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
        ]);

        Booking::create([
            'user_id' => auth()->id() ?? 1,
            'program_id' => $validated['program_id'],
            'trainer_id' => $validated['trainer_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'status' => 'pending',
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your booking has been confirmed! We look forward to seeing you.',
            ]);
        }

        return back()->with('success', 'Your booking has been confirmed! We look forward to seeing you.');
    }

    public function checkSchedule(Request $request)
    {
        $date = Carbon::parse($request->date);
        $dayName = $date->format('l');

        $trainer = Trainer::find($request->trainer_id);

        return response()->json([
            'day' => $dayName,
            'trainer' => $trainer?->name,
        ]);
    }
}
