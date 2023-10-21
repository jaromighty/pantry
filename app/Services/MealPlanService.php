<?php

namespace App\Services;

use App\Exceptions\RecipeCountLowException;
use App\Models\MealPlan;
use App\Models\Recipe;

class MealPlanService
{
    /**
     * @throws RecipeCountLowException
     */
    public function generate(): MealPlan
    {
        if (Recipe::count() < 6) {
            throw new RecipeCountLowException('Not enough recipes to create a meal plan');
        }
    }
}
