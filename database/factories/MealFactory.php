<?php

namespace Database\Factories;

use App\Enums\MealType;
use App\Models\Meal;
use Carbon\Carbon;
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
            'date' => Carbon::now()->addDays(2),
            'type' => MealType::BREAKFAST,
        ];
    }
}
