<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Plan;
use App\Models\Program;
use App\Models\ProgressLog;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_belongs_to_plan(): void
    {
        $plan = Plan::factory()->create();
        $user = User::factory()->create(['plan_id' => $plan->id]);

        $this->assertInstanceOf(Plan::class, $user->plan);
        $this->assertEquals($plan->id, $user->plan->id);
    }

    public function test_user_has_many_bookings(): void
    {
        $user = User::factory()->create();
        Booking::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->bookings);
    }

    public function test_user_has_many_progress_logs(): void
    {
        $user = User::factory()->create();
        ProgressLog::factory()->count(2)->create(['user_id' => $user->id]);

        $this->assertCount(2, $user->progressLogs);
    }

    public function test_booking_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $booking->user);
        $this->assertEquals($user->id, $booking->user->id);
    }

    public function test_booking_belongs_to_trainer(): void
    {
        $trainer = Trainer::factory()->create();
        $booking = Booking::factory()->create(['trainer_id' => $trainer->id]);

        $this->assertInstanceOf(Trainer::class, $booking->trainer);
        $this->assertEquals($trainer->id, $booking->trainer->id);
    }

    public function test_booking_belongs_to_program(): void
    {
        $program = Program::factory()->create();
        $booking = Booking::factory()->create(['program_id' => $program->id]);

        $this->assertInstanceOf(Program::class, $booking->program);
        $this->assertEquals($program->id, $booking->program->id);
    }

    public function test_progress_log_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $log = ProgressLog::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $log->user);
        $this->assertEquals($user->id, $log->user->id);
    }

    public function test_user_is_admin_scope(): void
    {
        $admin = User::factory()->admin()->create();
        $regular = User::factory()->create();

        $this->assertTrue($admin->is_admin);
        $this->assertFalse($regular->is_admin);
    }

    public function test_plan_has_no_children_relationships(): void
    {
        $plan = Plan::factory()->create();

        $this->assertNotNull($plan->name);
        $this->assertNotNull($plan->features);
        $this->assertIsArray($plan->features);
    }

    public function test_trainer_has_cast_attributes(): void
    {
        $social = ['instagram' => 'https://instagram.com/test'];
        $certifications = ['Certified Personal Trainer'];

        $trainer = Trainer::factory()->create([
            'social_links' => $social,
            'certifications' => $certifications,
        ]);

        $this->assertIsArray($trainer->social_links);
        $this->assertIsArray($trainer->certifications);
        $this->assertEquals($social['instagram'], $trainer->social_links['instagram']);
    }
}
