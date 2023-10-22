<?php

namespace App\Jobs;

use App\Models\Day;
use App\Models\Meal;
use App\Models\MealPlan;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreMealPlan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(Request $generatedMealPlan): void
    {
        $mealPlan = MealPlan::create([
            'start_date' => Carbon::parse($generatedMealPlan['start_date']),
            'end_date' => Carbon::parse($generatedMealPlan['end_date']),
        ]);

        foreach ($generatedMealPlan['days'] as $generatedDay) {
            $day = Day::create([
                'date' => Carbon::parse($generatedDay['date']),
                'meal_plan_id' => $mealPlan->id,
            ]);

            foreach ($generatedDay['meals'] as $generatedMeal) {
                $meal = Meal::create([
                    'type' => $generatedMeal['type'],
                ]);

                foreach ($generatedMeal['recipes'] as $recipe) {
                    $meal->recipes()->save(
                        Recipe::where('id', $recipe['id'])->first(),
                    );
                }
            }
        }
    }
}
