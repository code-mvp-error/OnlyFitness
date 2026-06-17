<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Plan;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $member;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->member = User::factory()->create(['goal' => 'general_fitness']);
    }

    public function test_admin_dashboard_returns_200(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->member)->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    public function test_admin_members_page_returns_200(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.members'));
        $response->assertStatus(200);
    }

    public function test_admin_can_create_member(): void
    {
        $plan = Plan::factory()->create();

        $response = $this->actingAs($this->admin)->post(route('admin.members.store'), [
            'name' => 'New Member',
            'email' => 'new@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '555-0001',
            'goal' => 'general_fitness',
            'plan_id' => $plan->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => 'new@example.com']);
    }

    public function test_admin_can_update_member(): void
    {
        $response = $this->actingAs($this->admin)->put(route('admin.members.update', $this->member->id), [
            'name' => 'Updated Member',
            'email' => $this->member->email,
            'phone' => '555-0002',
            'goal' => 'general_fitness',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'id' => $this->member->id,
            'name' => 'Updated Member',
        ]);
    }

    public function test_admin_can_delete_member(): void
    {
        $response = $this->actingAs($this->admin)->delete(route('admin.members.destroy', $this->member->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', ['id' => $this->member->id]);
    }

    public function test_admin_cannot_delete_self(): void
    {
        $response = $this->actingAs($this->admin)->delete(route('admin.members.destroy', $this->admin->id));

        $response->assertStatus(302);
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $this->admin->id]);
    }

    // ---- Bookings ----

    public function test_admin_bookings_page_returns_200(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.bookings'));
        $response->assertStatus(200);
    }

    public function test_admin_can_confirm_booking(): void
    {
        $booking = Booking::factory()->pending()->create(['user_id' => $this->member->id]);

        $response = $this->actingAs($this->admin)->put(route('admin.bookings.confirm', $booking->id));

        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_admin_can_cancel_booking(): void
    {
        $booking = Booking::factory()->confirmed()->create(['user_id' => $this->member->id]);

        $response = $this->actingAs($this->admin)->put(route('admin.bookings.cancel', $booking->id));

        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_admin_can_reschedule_booking(): void
    {
        $booking = Booking::factory()->confirmed()->create(['user_id' => $this->member->id]);
        $newDate = now()->addDays(5)->format('Y-m-d');

        $response = $this->actingAs($this->admin)->put(route('admin.bookings.reschedule', $booking->id), [
            'date' => $newDate,
            'time' => '14:00',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'date' => $newDate,
            'time' => '14:00',
        ]);
    }

    public function test_admin_can_delete_booking(): void
    {
        $booking = Booking::factory()->create(['user_id' => $this->member->id]);

        $response = $this->actingAs($this->admin)->delete(route('admin.bookings.destroy', $booking->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    // ---- Trainers ----

    public function test_admin_trainers_page_returns_200(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.trainers'));
        $response->assertStatus(200);
    }

    public function test_admin_can_create_trainer(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.trainers.store'), [
            'name' => 'New Trainer',
            'specialty' => 'HIIT',
            'bio' => 'A great trainer',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('trainers', ['name' => 'New Trainer']);
    }

    public function test_admin_can_update_trainer(): void
    {
        $trainer = Trainer::factory()->create();

        $response = $this->actingAs($this->admin)->put(route('admin.trainers.update', $trainer->id), [
            'name' => 'Updated Trainer',
            'specialty' => $trainer->specialty,
            'bio' => $trainer->bio,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('trainers', [
            'id' => $trainer->id,
            'name' => 'Updated Trainer',
        ]);
    }

    public function test_admin_can_delete_trainer(): void
    {
        $trainer = Trainer::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.trainers.destroy', $trainer->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('trainers', ['id' => $trainer->id]);
    }

    // ---- Contacts ----

    public function test_admin_contacts_page_returns_200(): void
    {
        Contact::factory()->count(3)->create();
        $response = $this->actingAs($this->admin)->get(route('admin.contacts'));
        $response->assertStatus(200);
    }

    public function test_admin_can_contact_reply(): void
    {
        $contact = Contact::factory()->create();
        $response = $this->actingAs($this->admin)->post(route('admin.contacts.reply', $contact->id), [
            'reply' => 'Thank you for reaching out!',
        ]);

        $response->assertStatus(302);
    }

    public function test_admin_can_mark_contact_read(): void
    {
        $contact = Contact::factory()->create(['status' => 'unread']);

        $response = $this->actingAs($this->admin)->put(route('admin.contacts.read', $contact->id));

        $response->assertStatus(302);
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'status' => 'read',
        ]);
    }

    public function test_admin_can_archive_contact(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->admin)->put(route('admin.contacts.archive', $contact->id));

        $response->assertStatus(302);
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'status' => 'archived',
        ]);
    }

    public function test_admin_can_delete_contact(): void
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.contacts.destroy', $contact->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    public function test_guest_cannot_access_admin_pages(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }
}
