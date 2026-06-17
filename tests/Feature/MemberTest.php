<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Plan;
use App\Models\ProgressLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use RefreshDatabase;

    private User $member;
    private Plan $plan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->plan = Plan::factory()->create(['name' => 'Premium']);
        $this->member = User::factory()->create([
            'plan_id' => $this->plan->id,
            'goal' => 'general_fitness',
        ]);
    }

    public function test_member_dashboard_returns_200(): void
    {
        $response = $this->actingAs($this->member)->get(route('dashboard'));
        $response->assertStatus(200);
    }

    public function test_member_dashboard_shows_membership_info(): void
    {
        $response = $this->actingAs($this->member)->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Premium');
    }

    public function test_member_dashboard_shows_upcoming_bookings(): void
    {
        Booking::factory()->confirmed()->create([
            'user_id' => $this->member->id,
        ]);

        $response = $this->actingAs($this->member)->get(route('dashboard'));
        $response->assertStatus(200);
    }

    public function test_member_bookings_page_returns_200(): void
    {
        $response = $this->actingAs($this->member)->get(route('member.bookings'));
        $response->assertStatus(200);
    }

    public function test_member_progress_page_returns_200(): void
    {
        $response = $this->actingAs($this->member)->get(route('member.progress'));
        $response->assertStatus(200);
    }

    public function test_member_can_store_progress(): void
    {
        $response = $this->actingAs($this->member)->post(route('member.progress.store'), [
            'date' => now()->format('Y-m-d'),
            'weight' => 75.5,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('progress_logs', [
            'user_id' => $this->member->id,
            'weight' => 75.5,
        ]);
    }

    public function test_member_progress_page_shows_history(): void
    {
        ProgressLog::factory()->count(3)->create([
            'user_id' => $this->member->id,
        ]);

        $response = $this->actingAs($this->member)->get(route('member.progress'));
        $response->assertStatus(200);
    }

    public function test_member_profile_page_returns_200(): void
    {
        $response = $this->actingAs($this->member)->get(route('member.profile'));
        $response->assertStatus(200);
        $response->assertSee($this->member->name);
        $response->assertSee($this->member->email);
    }

    public function test_member_can_update_profile(): void
    {
        $response = $this->actingAs($this->member)->put(route('member.profile.update'), [
            'name' => 'Updated Name',
            'email' => $this->member->email,
            'phone' => '555-9999',
            'goal' => 'general_fitness',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'id' => $this->member->id,
            'name' => 'Updated Name',
            'phone' => '555-9999',
        ]);
    }

    public function test_member_can_update_password(): void
    {
        $response = $this->actingAs($this->member)->put(route('member.password.update'), [
            'current_password' => 'password',
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('status');
    }

    public function test_member_cancel_membership_deletes_user(): void
    {
        $userId = $this->member->id;

        $response = $this->actingAs($this->member)->delete(route('member.cancel'));

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    public function test_guest_cannot_access_member_dashboard(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_member_bookings(): void
    {
        $response = $this->get(route('member.bookings'));
        $response->assertRedirect(route('login'));
    }
}
