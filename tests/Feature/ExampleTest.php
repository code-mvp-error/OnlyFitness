<?php

namespace Tests\Feature;

use App\Models\Program;
use App\Models\Trainer;
use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        Program::factory()->count(2)->create();
        Trainer::factory()->count(2)->create();
        Plan::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
