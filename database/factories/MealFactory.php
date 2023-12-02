<?php

namespace Database\Factories;

use App\Enums\MealType;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => MealType::BREAKFAST,
            'day_id' => 1,
        ];
    }
}
