<?php

namespace Tests\Feature\Services;

use App\Enums\MealType;
use App\Enums\RecipeType;
use App\Models\Day;
use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\MealPlan;
use App\Models\Recipe;
use App\Services\ShoppingListService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShoppingListServiceTest extends TestCase
{
    use RefreshDatabase;

    private ShoppingListService $shoppingListService;

    private MealPlan $mealPlan;

    public function setUp(): void
    {
        parent::setUp();

        $this->shoppingListService = new ShoppingListService();
        $this->mealPlan = MealPlan::factory()->create();
    }

    public function test_a_shopping_list_can_be_generated(): void
    {
        $shoppingList = $this->shoppingListService->generate($this->mealPlan->id);

        $this->assertNotNull($shoppingList);
        $this->assertEquals(
            Carbon::parse($this->mealPlan->start_date)->format('Y-m-d'),
            $shoppingList->mealPlan->start_date
        );
    }

    public function test_a_list_of_ingredients_can_be_created(): void
    {
        foreach (range(0, 6) as $numDays) {
            $day = Day::factory()->create([
                'date' => Carbon::now()->addDays($numDays),
                'meal_plan_id' => $this->mealPlan->id,
            ]);

            foreach ([MealType::BREAKFAST->value, MealType::LUNCH->value, MealType::DINNER->value] as $mealType) {
                $meal = Meal::factory()->create([
                    'type' => $mealType,
                    'day_id' => $day->id,
                ]);

                foreach ([RecipeType::BREAKFAST->value, RecipeType::LUNCH->value, RecipeType::DINNER->value] as $recipeType) {
                    $recipe = Recipe::factory()->create();
                    $newIngredients = Ingredient::factory(3)->create();
                    $recipe->ingredients()->attach($newIngredients);
                    $meal->recipes()->save($recipe);
                }
            }
        }

        $ingredients = $this->shoppingListService->getIngredients($this->mealPlan->id);

        $this->assertGreaterThan(0, count($ingredients));
    }
}
