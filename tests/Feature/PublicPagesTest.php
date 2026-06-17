<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\Program;
use App\Models\Trainer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Program::factory()->count(3)->create();
        Trainer::factory()->count(3)->create();
        Plan::factory()->count(3)->create();
    }

    public function test_home_page_returns_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_programs_page_returns_200(): void
    {
        $response = $this->get(route('programs'));
        $response->assertStatus(200);
    }

    public function test_trainers_page_returns_200(): void
    {
        $response = $this->get(route('trainers'));
        $response->assertStatus(200);
    }

    public function test_pricing_page_returns_200(): void
    {
        $response = $this->get(route('pricing'));
        $response->assertStatus(200);
    }

    public function test_contact_page_returns_200(): void
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
    }

    public function test_unknown_page_returns_404(): void
    {
        $response = $this->get('/non-existent-page');
        $response->assertStatus(404);
    }

    public function test_home_page_has_required_sections(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ONLY');
        $response->assertSee('Fitness');
        $response->assertSee('Our Programs');
        $response->assertSee('Elite Trainers');
        $response->assertSee('Choose Your Plan');
        $response->assertSee('Start Your Transformation');
        $response->assertSee('Frequently Asked Questions');
    }

    public function test_programs_page_displays_programs(): void
    {
        $program = Program::factory()->create(['name' => 'Test Program']);
        $response = $this->get(route('programs'));
        $response->assertStatus(200);
        $response->assertSee('Test Program');
    }

    public function test_trainers_page_displays_trainers(): void
    {
        $trainer = Trainer::factory()->create(['name' => 'Test Trainer']);
        $response = $this->get(route('trainers'));
        $response->assertStatus(200);
        $response->assertSee('Test Trainer');
    }

    public function test_pricing_page_displays_plans(): void
    {
        $plan = Plan::factory()->create(['name' => 'TestPlan']);
        $response = $this->get(route('pricing'));
        $response->assertStatus(200);
        $response->assertSee('TestPlan');
    }
}
