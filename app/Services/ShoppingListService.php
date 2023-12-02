<?php

namespace App\Services;

use App\Models\MealPlan;
use App\Models\ShoppingList;

class ShoppingListService
{
    public function generate(int $mealPlanId): ShoppingList
    {
        $shoppingList = ShoppingList::factory()->create([
            'meal_plan_id' => $mealPlanId,
        ]);

        $ingredients = $this->getIngredients($mealPlanId);

        foreach ($ingredients as $ingredient) {
            $shoppingList->ingredients()->attach(
                $ingredient['id'], [
                    'quantity' => $ingredient['quantity'],
                ],
            );
        }

        return $shoppingList;
    }

    public function getIngredients(int $mealPlanId): array
    {
        $mealPlan = MealPlan::find($mealPlanId);
        $ingredients = [];
        foreach ($mealPlan->days as $day) {
            foreach ($day->meals as $meal) {
                foreach ($meal->recipes as $recipe) {
                    foreach ($recipe->ingredients as $ingredient) {
                        if (! in_array($ingredient->id, array_column($ingredients, 'id'))) {
                            $ingredients[] = [
                                'id' => $ingredient->id,
                                'quantity' => 1,
                            ];
                        } else {
                            $ingredients[array_search($ingredient, $ingredients)]['quantity']++;
                        }
                    }
                }
            }
        }

        return $ingredients;
    }
}
