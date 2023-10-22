<?php

namespace App\Services;

use App\Enums\MealType;
use App\Enums\RecipeType;
use App\Exceptions\RecipeCountLowException;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class MealPlanService
{
    /**
     * @throws RecipeCountLowException
     */
    public function generate(): Collection
    {
        if (Recipe::count() < 6) {
            throw new RecipeCountLowException('Not enough recipes to create a meal plan');
        }

        $mealPlan = collect([
            'start_date' => Carbon::now()->next('Monday'),
            'end_date' => Carbon::now()->next('Monday')->addDays(6),
            'days' => collect(),
        ]);

        $breakfastRecipes = collect(Recipe::where('type', RecipeType::BREAKFAST->value)->orderByRaw('RAND()')->take(7)->get());
        $lunchRecipes = collect(Recipe::where('type', RecipeType::LUNCH->value)->orderByRaw('RAND()')->take(7)->get());
        $dinnerRecipes = collect(Recipe::where('type', RecipeType::DINNER->value)->orderByRaw('RAND()')->take(6)->get());
        $dessertRecipe = collect(Recipe::where('type', RecipeType::DESSERT->value)->orderByRaw('RAND()')->take(1)->get());

        for ($i = 0;$i < 7;$i++) {
            $day = collect([
                'date' => Carbon::parse($mealPlan['start_date'])->addDays($i),
                'meals' => collect(),
            ]);
            $meals = [
                collect([
                    'type' => MealType::BREAKFAST->value,
                    'recipes' => collect(),
                ]),
                collect([
                    'type' => MealType::LUNCH->value,
                    'recipes' => collect(),
                ]),
                collect([
                    'type' => $i < 6 ? MealType::DINNER->value : MealType::DESSERT->value,
                    'recipes' => collect(),
                ]),
            ];
            $meals[0]['recipes']->push($breakfastRecipes[$i]);
            $meals[1]['recipes']->push($lunchRecipes[$i]);
            if ($i < 6) {
                $meals[2]['recipes']->push($dinnerRecipes[$i]);
            } else {
                $meals[2]['recipes']->push($dessertRecipe);
            }

            $day['meals']->push($meals);
            $mealPlan['days']->push($day);
        }

        return $mealPlan;
    }
}
