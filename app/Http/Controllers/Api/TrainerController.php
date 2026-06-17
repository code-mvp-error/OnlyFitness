<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @api {get} /api/trainers List all trainers
 * @apiName GetTrainers
 * @apiGroup Trainers
 * @apiQuery {String} [specialty] Filter by specialty
 * @apiSuccess {Object[]} data List of trainers
 */
class TrainerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Trainer::query();

        if ($specialty = $request->specialty) {
            $query->where('specialty', 'LIKE', "%{$specialty}%");
        }

        $trainers = $query->get()->map(fn($t) => $this->formatTrainer($t));

        return response()->json([
            'success' => true,
            'data' => $trainers,
            'message' => null,
        ]);
    }

    /**
     * @api {get} /api/trainers/:id Get trainer details
     * @apiName GetTrainer
     * @apiGroup Trainers
     * @apiParam {Number} id Trainer ID
     * @apiSuccess {Object} data Full trainer details
     */
    public function show(int $id): JsonResponse
    {
        $trainer = Trainer::withCount('bookings')->find($id);

        if (!$trainer) {
            return response()->json([
                'success' => false,
                'error' => 'Trainer not found',
                'code' => 404,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatTrainer($trainer, true),
            'message' => null,
        ]);
    }

    /**
     * @api {get} /api/trainers/:id/availability Get trainer availability
     * @apiName GetTrainerAvailability
     * @apiGroup Trainers
     * @apiParam {Number} id Trainer ID
     * @apiQuery {String} [date] Date (default: today)
     * @apiSuccess {Object[]} data Available time slots
     */
    public function availability(int $id, Request $request): JsonResponse
    {
        $trainer = Trainer::find($id);

        if (!$trainer) {
            return response()->json([
                'success' => false,
                'error' => 'Trainer not found',
                'code' => 404,
            ], 404);
        }

        $date = $request->date ? \Carbon\Carbon::parse($request->date) : now();
        $allSlots = ['06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00'];

        $bookedSlots = $trainer->bookings()
            ->whereDate('date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('time')
            ->map(fn($t) => \Carbon\Carbon::parse($t)->format('H:i'))
            ->toArray();

        $available = array_values(array_diff($allSlots, $bookedSlots));

        return response()->json([
            'success' => true,
            'data' => [
                'date' => $date->format('Y-m-d'),
                'available_slots' => $available,
            ],
            'message' => null,
        ]);
    }

    private function formatTrainer(Trainer $trainer, bool $full = false): array
    {
        $data = [
            'id' => $trainer->id,
            'name' => $trainer->name,
            'photo_url' => $trainer->photo,
            'specialty' => $trainer->specialty,
            'bio' => $trainer->bio,
            'certifications' => $trainer->certifications ?? [],
        ];

        if ($full) {
            $data['social_links'] = $trainer->social_links ?? [];
            $data['total_sessions'] = $trainer->bookings_count ?? 0;
        }

        return $data;
    }
}
