<?php

namespace Tests\Feature\Services;

use App\Enums\RecipeType;
use App\Exceptions\RecipeCountLowException;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Services\MealPlanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MealPlanServiceTest extends TestCase
{
    use RefreshDatabase;

    private MealPlanService $mealPlanService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mealPlanService = new MealPlanService();
    }

    /**
     * @throws RecipeCountLowException
     */
    public function test_a_meal_plan_can_be_generated(): void
    {
        $breakfastRecipes = Recipe::factory(7)->create([
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ($breakfastRecipes as $recipe) {
            $recipe->ingredients()->attach(Ingredient::factory(rand(4,12))->create());
        }

        $lunchRecipes = Recipe::factory(7)->create([
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ($lunchRecipes as $recipe) {
            $recipe->ingredients()->attach(Ingredient::factory(rand(4,12))->create());
        }

        $dinnerRecipes = Recipe::factory(6)->create([
            'type' => RecipeType::DINNER->value,
        ]);
        foreach ($dinnerRecipes as $recipe) {
            $recipe->ingredients()->attach(Ingredient::factory(rand(4,12))->create());
        }

        Recipe::factory()->create([
            'type' => RecipeType::DESSERT->value,
        ])->ingredients()->attach(Ingredient::factory(rand(4,12))->create());

        $mealPlan = $this->mealPlanService->generate();

        $this->assertNotNull($mealPlan);
    }
}
