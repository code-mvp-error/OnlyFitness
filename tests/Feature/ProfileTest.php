<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $plan = Plan::factory()->create();
        $user = User::factory()->create(['plan_id' => $plan->id]);

        $response = $this->actingAs($user)->get(route('member.profile'));

        $response->assertOk();
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create(['goal' => 'general_fitness']);

        $response = $this->actingAs($user)->put(route('member.profile.update'), [
            'name' => 'Test User',
            'email' => $user->email,
            'phone' => '555-1234',
            'goal' => 'general_fitness',
        ]);

        $response->assertSessionHasNoErrors()->assertSessionHas('status');

        $user->refresh();
        $this->assertSame('Test User', $user->name);
    }

    public function test_profile_page_requires_authentication(): void
    {
        $response = $this->get(route('member.profile'));
        $response->assertRedirect(route('login'));
    }

    public function test_user_can_cancel_membership(): void
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $response = $this->actingAs($user)->delete(route('member.cancel'));

        $response->assertRedirect('/');
        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    public function test_user_can_update_password(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('member.password.update'), [
            'current_password' => 'password',
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertSessionHasNoErrors()->assertSessionHas('status');
    }

    public function test_password_update_requires_correct_current_password(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('member.password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertSessionHasErrors('current_password');
    }
}
