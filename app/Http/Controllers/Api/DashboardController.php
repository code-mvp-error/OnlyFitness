<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ProgressLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @api {get} /api/dashboard Get member dashboard data
 * @apiName GetDashboard
 * @apiGroup Dashboard
 * @apiHeader {String} Authorization Bearer token
 * @apiSuccess {Object} data Dashboard with membership, stats, upcoming bookings
 */
class DashboardController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user()->load('plan');

        $workoutsThisMonth = Booking::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->count();

        $totalSessions = Booking::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $latestWeight = ProgressLog::where('user_id', $user->id)->latest('date')->first();
        $streak = $this->calculateStreak($user);

        $upcomingBookings = Booking::with(['program', 'trainer'])
            ->where('user_id', $user->id)
            ->where('date', '>=', now()->toDateString())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('date')
            ->orderBy('time')
            ->take(5)
            ->get()
            ->map(fn($b) => [
                'id' => $b->id,
                'program' => $b->program?->name ?? 'General Session',
                'date' => $b->date,
                'time' => \Carbon\Carbon::parse($b->time)->format('H:i'),
                'trainer' => $b->trainer?->name ?? 'TBD',
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'membership' => [
                    'plan' => $user->plan?->name ?? 'Free',
                    'expires' => $user->created_at->addYear()->format('Y-m-d'),
                    'status' => $user->plan ? 'active' : 'inactive',
                ],
                'stats' => [
                    'workouts_this_month' => $workoutsThisMonth,
                    'total_sessions' => $totalSessions,
                    'current_streak' => $streak,
                    'current_weight' => $latestWeight?->weight,
                ],
                'upcoming_bookings' => $upcomingBookings,
            ],
            'message' => null,
        ]);
    }

    private function calculateStreak($user): int
    {
        $bookings = Booking::where('user_id', $user->id)
            ->where('status', 'completed')
            ->orderBy('date', 'desc')
            ->pluck('date');

        if ($bookings->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $date = now()->toDateString();

        foreach ($bookings as $bookingDate) {
            if ($bookingDate === $date) {
                $streak++;
                $date = \Carbon\Carbon::parse($date)->subDay()->toDateString();
            } elseif ($bookingDate < $date) {
                break;
            }
        }

        return $streak;
    }
}
