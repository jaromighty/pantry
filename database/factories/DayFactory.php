<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\MealPlan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Day>
 */
class DayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => Carbon::now()->addDays(rand(1, 8)),
            'meal_plan_id' => MealPlan::factory()->create()->id,
        ];
    }
}
