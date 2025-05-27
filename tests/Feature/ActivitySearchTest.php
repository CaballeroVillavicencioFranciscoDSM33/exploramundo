<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;

class ActivitySearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_buscar_actividades_disponibles(): void
    {
        $activity = Activity::factory()->create([
            'start_date' => Carbon::now()->addDays(2),
            'end_date' => Carbon::now()->addDays(10),
            'price_per_person' => 100,
        ]);

        $response = $this->get('/activities/search?date=' . Carbon::now()->addDays(3)->toDateString() . '&people=2');

        $response->assertStatus(200);
        $response->assertSee($activity->title);
    }
}
