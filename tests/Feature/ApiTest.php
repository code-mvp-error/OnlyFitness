<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Plan;
use App\Models\Program;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Plan $plan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->plan = Plan::factory()->create();
        $this->user = User::factory()->create([
            'password' => Hash::make('password'),
            'plan_id' => $this->plan->id,
            'goal' => 'general_fitness',
        ]);
    }

    // ---- Auth ----

    public function test_api_register(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '555-1234',
            'goal' => 'general_fitness',
            'plan_id' => $this->plan->id,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['token', 'user']]);
    }

    public function test_api_login(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['token', 'user']]);
    }

    public function test_api_login_with_invalid_credentials(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401);
    }

    public function test_api_logout(): void
    {
        Sanctum::actingAs($this->user);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);
    }

    public function test_api_get_user(): void
    {
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/user');

        $response->assertStatus(200)
            ->assertJsonPath('data.user.email', $this->user->email);
    }

    public function test_api_update_user(): void
    {
        Sanctum::actingAs($this->user);

        $response = $this->putJson('/api/user', [
            'name' => 'Updated API User',
            'phone' => '555-9999',
            'goal' => 'general_fitness',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Updated API User',
        ]);
    }

    public function test_api_update_password(): void
    {
        Sanctum::actingAs($this->user);

        $response = $this->putJson('/api/user/password', [
            'current_password' => 'password',
            'new_password' => 'NewPassword123!',
            'new_password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertStatus(200);
    }

    // ---- Programs ----

    public function test_api_list_programs(): void
    {
        Program::factory()->count(3)->create();

        $response = $this->getJson('/api/programs');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_api_show_program(): void
    {
        $program = Program::factory()->create();

        $response = $this->getJson("/api/programs/{$program->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $program->id);
    }

    public function test_api_program_schedule(): void
    {
        $program = Program::factory()->create();

        $response = $this->getJson("/api/programs/{$program->id}/schedule");

        $response->assertStatus(200);
    }

    public function test_api_show_program_404(): void
    {
        $response = $this->getJson('/api/programs/999');

        $response->assertStatus(404);
    }

    // ---- Trainers ----

    public function test_api_list_trainers(): void
    {
        Trainer::factory()->count(3)->create();

        $response = $this->getJson('/api/trainers');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_api_show_trainer(): void
    {
        $trainer = Trainer::factory()->create();

        $response = $this->getJson("/api/trainers/{$trainer->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $trainer->id);
    }

    public function test_api_trainer_availability(): void
    {
        $trainer = Trainer::factory()->create();

        $response = $this->getJson("/api/trainers/{$trainer->id}/availability");

        $response->assertStatus(200);
    }

    // ---- Bookings (authenticated) ----

    public function test_api_list_bookings(): void
    {
        Sanctum::actingAs($this->user);
        Booking::factory()->count(2)->create(['user_id' => $this->user->id]);

        $response = $this->getJson('/api/bookings');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    public function test_api_create_booking(): void
    {
        Sanctum::actingAs($this->user);
        $trainer = Trainer::factory()->create();
        $program = Program::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'trainer_id' => $trainer->id,
            'program_id' => $program->id,
            'date' => now()->addDays(3)->format('Y-m-d'),
            'time' => '10:00',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['id']]);
    }

    public function test_api_show_booking(): void
    {
        Sanctum::actingAs($this->user);
        $booking = Booking::factory()->create(['user_id' => $this->user->id]);

        $response = $this->getJson("/api/bookings/{$booking->id}");

        $response->assertStatus(200);
    }

    public function test_api_delete_booking(): void
    {
        Sanctum::actingAs($this->user);
        $booking = Booking::factory()->pending()->create([
            'user_id' => $this->user->id,
            'date' => now()->addDays(3)->format('Y-m-d'),
        ]);

        $response = $this->deleteJson("/api/bookings/{$booking->id}");

        $response->assertStatus(200);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_api_cannot_access_other_user_booking(): void
    {
        Sanctum::actingAs($this->user);
        $otherUser = User::factory()->create();
        $booking = Booking::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->getJson("/api/bookings/{$booking->id}");

        $response->assertStatus(404);
    }

    // ---- Dashboard ----

    public function test_api_dashboard(): void
    {
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/dashboard');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['membership', 'stats', 'upcoming_bookings']]);
    }

    // ---- Unauthenticated access ----

    public function test_api_unauthenticated_cannot_access_bookings(): void
    {
        $response = $this->getJson('/api/bookings');
        $response->assertStatus(401);
    }

    public function test_api_unauthenticated_cannot_access_dashboard(): void
    {
        $response = $this->getJson('/api/dashboard');
        $response->assertStatus(401);
    }

    public function test_api_unauthenticated_cannot_access_user(): void
    {
        $response = $this->getJson('/api/user');
        $response->assertStatus(401);
    }
}
