<?php

namespace Database\Factories;

use App\Models\MealPlan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MealPlan>
 */
class MealPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => Carbon::now()->next('Monday'),
            'end_date' => Carbon::now()->next('Monday')->addDays(6),
        ];
    }
}
