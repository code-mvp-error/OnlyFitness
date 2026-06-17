<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Program;
use App\Models\Trainer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @api {get} /api/bookings List user bookings
 * @apiName GetBookings
 * @apiGroup Bookings
 * @apiHeader {String} Authorization Bearer token
 * @apiSuccess {Object[]} data List of bookings
 */
class BookingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $bookings = $request->user()->bookings()
            ->with(['program', 'trainer'])
            ->orderBy('date', 'desc')
            ->get()
            ->map(fn($b) => $this->formatBooking($b));

        return response()->json([
            'success' => true,
            'data' => $bookings,
            'message' => null,
        ]);
    }

    /**
     * @api {post} /api/bookings Create a booking
     * @apiName CreateBooking
     * @apiGroup Bookings
     * @apiHeader {String} Authorization Bearer token
     * @apiParam {Number} program_id Program ID
     * @apiParam {Number} [trainer_id] Trainer ID
     * @apiParam {String} date Booking date (Y-m-d)
     * @apiParam {String} time Booking time (H:i)
     * @apiSuccess {Object} data Created booking
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
            'trainer_id' => ['nullable', 'exists:trainers,id'],
            'date' => ['required', 'date', 'after:' . now()->subDay()->format('Y-m-d')],
            'time' => ['required', 'date_format:H:i'],
        ]);

        if ($validated['trainer_id']) {
            $trainer = Trainer::find($validated['trainer_id']);
            $timeFormatted = \Carbon\Carbon::parse($validated['time'])->format('H:i');

            $conflict = $trainer->bookings()
                ->whereDate('date', $validated['date'])
                ->whereTime('time', $timeFormatted)
                ->whereIn('status', ['pending', 'confirmed'])
                ->exists();

            if ($conflict) {
                return response()->json([
                    'success' => false,
                    'error' => 'This time slot is already booked',
                    'code' => 409,
                ], 409);
            }
        }

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'program_id' => $validated['program_id'],
            'trainer_id' => $validated['trainer_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'status' => 'confirmed',
        ]);

        $booking->load(['program', 'trainer']);

        return response()->json([
            'success' => true,
            'data' => $this->formatBooking($booking),
            'message' => 'Booking confirmed',
        ], 201);
    }

    /**
     * @api {get} /api/bookings/:id Get booking details
     * @apiName GetBooking
     * @apiGroup Bookings
     * @apiHeader {String} Authorization Bearer token
     * @apiParam {Number} id Booking ID
     * @apiSuccess {Object} data Booking details
     */
    public function show(int $id, Request $request): JsonResponse
    {
        $booking = Booking::with(['program', 'trainer'])->find($id);

        if (!$booking || $booking->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'error' => 'Booking not found',
                'code' => 404,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatBooking($booking),
            'message' => null,
        ]);
    }

    /**
     * @api {delete} /api/bookings/:id Cancel a booking
     * @apiName CancelBooking
     * @apiGroup Bookings
     * @apiHeader {String} Authorization Bearer token
     * @apiParam {Number} id Booking ID
     * @apiSuccess {String} message Success message
     */
    public function destroy(int $id, Request $request): JsonResponse
    {
        $booking = Booking::find($id);

        if (!$booking || $booking->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'error' => 'Booking not found',
                'code' => 404,
            ], 404);
        }

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return response()->json([
                'success' => false,
                'error' => 'Booking cannot be cancelled',
                'code' => 400,
            ], 400);
        }

        if (\Carbon\Carbon::parse($booking->date)->isPast()) {
            return response()->json([
                'success' => false,
                'error' => 'Cannot cancel past bookings',
                'code' => 400,
            ], 400);
        }

        $booking->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Booking cancelled',
        ]);
    }

    private function formatBooking(Booking $booking): array
    {
        return [
            'id' => $booking->id,
            'program' => $booking->program ? [
                'id' => $booking->program->id,
                'name' => $booking->program->name,
            ] : null,
            'trainer' => $booking->trainer ? [
                'id' => $booking->trainer->id,
                'name' => $booking->trainer->name,
            ] : null,
            'date' => $booking->date,
            'time' => \Carbon\Carbon::parse($booking->time)->format('H:i'),
            'status' => $booking->status,
            'created_at' => $booking->created_at,
        ];
    }
}
