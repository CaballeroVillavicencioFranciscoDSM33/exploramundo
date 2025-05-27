<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityAdminTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_admin_puede_crear_actividad()
    {
        $admin = \App\Models\User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $response = $this->post('/admin/activities', [
            'title' => 'Test Tour',
            'description' => 'Descripción',
            'start_date' => Carbon::now()->addDays(2)->toDateString(),
            'end_date' => Carbon::now()->addDays(4)->toDateString(),
            'price_per_person' => 200,
            'popularity' => 5,
        ]);

        $response->assertRedirect('/admin/activities');
        $this->assertDatabaseHas('activities', [
            'title' => 'Test Tour'
        ]);
    }
}
