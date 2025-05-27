<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Activity;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_hacer_una_reserva(): void
    {
        $activity = Activity::factory()->create([
            'start_date' => Carbon::now()->addDays(2),
            'end_date' => Carbon::now()->addDays(10),
            'price_per_person' => 50,
        ]);

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/reservations', [
            'activity_id' => $activity->id,
            'people' => 3,
            'execution_date' => Carbon::now()->addDays(3)->toDateString(),
        ]);

        $response->assertRedirect('/reservations'); 
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'people' => 3,
            'total_price' => 150,
        ]);
    }
    public function test_no_puede_reservar_fuera_de_rango()
{
    $activity = Activity::factory()->create([
        'start_date' => Carbon::now()->addDays(5),
        'end_date' => Carbon::now()->addDays(10),
        'price_per_person' => 100,
    ]);

    $user = \App\Models\User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/reservations', [
        'activity_id' => $activity->id,
        'people' => 2,
        'execution_date' => Carbon::now()->addDays(3)->toDateString(), // antes de start_date
    ]);

    $response->assertSessionHasErrors('execution_date');
    $this->assertDatabaseMissing('reservations', [
        'activity_id' => $activity->id,
    ]);
}

}
