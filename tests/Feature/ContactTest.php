<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_store_creates_contact(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '555-1234',
            'goal' => 'general_fitness',
            'plan' => 'pro',
            'message' => 'I want to get fit! This is my journey.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);
    }

    public function test_contact_store_requires_name(): void
    {
        $response = $this->post(route('contact.store'), [
            'email' => 'john@example.com',
            'phone' => '555-1234',
            'goal' => 'general_fitness',
            'plan' => 'pro',
            'message' => 'Test message here',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_contact_store_requires_email(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John',
            'phone' => '555-1234',
            'goal' => 'general_fitness',
            'plan' => 'pro',
            'message' => 'Test message here',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_contact_store_requires_valid_email(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John',
            'email' => 'not-an-email',
            'phone' => '555-1234',
            'goal' => 'general_fitness',
            'plan' => 'pro',
            'message' => 'Test message here',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_contact_store_requires_message(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'phone' => '555-1234',
            'goal' => 'general_fitness',
            'plan' => 'pro',
        ]);

        $response->assertSessionHasErrors('message');
    }

    public function test_contact_store_requires_phone(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'goal' => 'general_fitness',
            'plan' => 'pro',
            'message' => 'Test message here',
        ]);

        $response->assertSessionHasErrors('phone');
    }

    public function test_contact_store_requires_valid_goal(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'phone' => '555-1234',
            'goal' => 'Invalid Goal',
            'plan' => 'pro',
            'message' => 'Test message here',
        ]);

        $response->assertSessionHasErrors('goal');
    }

    public function test_contact_store_requires_plan(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'phone' => '555-1234',
            'goal' => 'general_fitness',
            'message' => 'Test message here',
        ]);

        $response->assertSessionHasErrors('plan');
    }

    public function test_admin_can_view_contacts(): void
    {
        Contact::factory()->count(3)->create();
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('admin.contacts'));
        $response->assertStatus(200);
    }

    public function test_admin_can_mark_contact_as_read(): void
    {
        $contact = Contact::factory()->create(['status' => 'unread']);
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->put(route('admin.contacts.read', $contact->id));

        $response->assertStatus(302);
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'status' => 'read',
        ]);
    }

    public function test_admin_can_archive_contact(): void
    {
        $contact = Contact::factory()->create();
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->put(route('admin.contacts.archive', $contact->id));

        $response->assertStatus(302);
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'status' => 'archived',
        ]);
    }

    public function test_admin_can_delete_contact(): void
    {
        $contact = Contact::factory()->create();
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->delete(route('admin.contacts.destroy', $contact->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    public function test_guest_cannot_view_admin_contacts(): void
    {
        $response = $this->get(route('admin.contacts'));
        $response->assertRedirect(route('login'));
    }
}
