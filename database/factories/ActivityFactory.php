<?php

namespace Database\Factories;


use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        $start = now()->addDays(rand(2, 10));
        $end = (clone $start)->addDays(rand(3, 8));

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'start_date' => $start,
            'end_date' => $end,
            'price_per_person' => $this->faker->randomFloat(2, 50, 300),
            'popularity' => rand(0, 100),
            'image_path' => null,
        ];
    }
}
