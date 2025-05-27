<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Activity;
use App\Models\Reservation;
use App\Models\Promotion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'is_admin' => true
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Usuario Demo',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
                'is_admin' => false
            ]
        );


        // Crear actividades con relaciones y algunas reservas
        Activity::factory(10)->create()->each(function ($activity) {
            $relatedIds = Activity::inRandomOrder()->where('id', '!=', $activity->id)->take(3)->pluck('id');
            $activity->related()->sync($relatedIds);

            // Simular reservas para algunas actividades
            if (rand(0, 1)) {
                Reservation::create([
                    'activity_id' => $activity->id,
                    'people' => rand(1, 5),
                    'reservation_date' => Carbon::now(),
                    'execution_date' => Carbon::now()->addDays(rand(2, 5)),
                    'total_price' => $activity->price_per_person * 3,
                ]);

                $activity->increment('popularity');
            }
        });

        // Crear promociones activas
        Promotion::factory()->count(3)->create();
    }
}
