<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Program;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $trainers = Trainer::all();
        $programs = Program::all();

        $bookings = [
            ['user' => 0, 'trainer' => 0, 'program' => 0, 'date' => '2026-07-01', 'time' => '09:00', 'status' => 'confirmed'],
            ['user' => 0, 'trainer' => 1, 'program' => 1, 'date' => '2026-07-02', 'time' => '10:00', 'status' => 'confirmed'],
            ['user' => 1, 'trainer' => 2, 'program' => 3, 'date' => '2026-07-03', 'time' => '11:00', 'status' => 'pending'],
            ['user' => 1, 'trainer' => 0, 'program' => 0, 'date' => '2026-07-05', 'time' => '14:00', 'status' => 'pending'],
            ['user' => 2, 'trainer' => 3, 'program' => 4, 'date' => '2026-07-04', 'time' => '16:00', 'status' => 'confirmed'],
            ['user' => 2, 'trainer' => 1, 'program' => 2, 'date' => '2026-07-06', 'time' => '09:00', 'status' => 'pending'],
            ['user' => 3, 'trainer' => 2, 'program' => 3, 'date' => '2026-07-07', 'time' => '10:00', 'status' => 'completed'],
            ['user' => 3, 'trainer' => 0, 'program' => 0, 'date' => '2026-07-08', 'time' => '18:00', 'status' => 'confirmed'],
            ['user' => 4, 'trainer' => 3, 'program' => 1, 'date' => '2026-07-09', 'time' => '11:00', 'status' => 'pending'],
            ['user' => 4, 'trainer' => 1, 'program' => 4, 'date' => '2026-07-10', 'time' => '14:00', 'status' => 'confirmed'],
        ];

        foreach ($bookings as $b) {
            Booking::create([
                'user_id' => $users[$b['user']]->id,
                'trainer_id' => $trainers[$b['trainer']]->id,
                'program_id' => $programs[$b['program']]->id,
                'date' => $b['date'],
                'time' => $b['time'],
                'status' => $b['status'],
            ]);
        }
    }
}
