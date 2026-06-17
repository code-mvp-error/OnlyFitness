<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @api {get} /api/programs List all programs
 * @apiName GetPrograms
 * @apiGroup Programs
 * @apiSuccess {Object[]} data List of programs
 */
class ProgramController extends Controller
{
    public function index(): JsonResponse
    {
        $programs = Program::all()->map(fn($p) => $this->formatProgram($p));

        return response()->json([
            'success' => true,
            'data' => $programs,
            'message' => null,
        ]);
    }

    /**
     * @api {get} /api/programs/:id Get program details
     * @apiName GetProgram
     * @apiGroup Programs
     * @apiParam {Number} id Program ID
     * @apiSuccess {Object} data Program with full details
     */
    public function show(int $id): JsonResponse
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'error' => 'Program not found',
                'code' => 404,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatProgram($program, true),
            'message' => null,
        ]);
    }

    /**
     * @api {get} /api/programs/:id/schedule Get program schedule
     * @apiName GetProgramSchedule
     * @apiGroup Programs
     * @apiParam {Number} id Program ID
     * @apiQuery {String} [date] Start date (default: today)
     * @apiSuccess {Object[]} data Array of date+slots
     */
    public function schedule(int $id, Request $request): JsonResponse
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json([
                'success' => false,
                'error' => 'Program not found',
                'code' => 404,
            ], 404);
        }

        $startDate = $request->date ? \Carbon\Carbon::parse($request->date) : now();
        $timeSlots = ['06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00'];

        $schedule = [];
        for ($d = 0; $d < 7; $d++) {
            $date = $startDate->copy()->addDays($d);
            $schedule[] = [
                'date' => $date->format('Y-m-d'),
                'slots' => $timeSlots,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $schedule,
            'message' => null,
        ]);
    }

    private function formatProgram(Program $program, bool $full = false): array
    {
        $data = [
            'id' => $program->id,
            'name' => $program->name,
            'description' => $program->description,
            'icon' => $program->icon,
            'duration' => $program->duration,
            'intensity' => $program->intensity,
            'features' => $program->features ?? [],
        ];

        if ($full) {
            $data['schedule'] = $program->schedule;
        }

        return $data;
    }
}
