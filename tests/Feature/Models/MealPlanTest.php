<?php

namespace Feature\Models;

use App\Enums\MealType;
use App\Enums\RecipeType;
use App\Models\Day;
use App\Models\MealPlan;
use App\Models\Recipe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MealPlanTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
    }

    public function test_a_meal_plan_can_be_created(): void
    {
        $response = $this->post(route('meal-plans.store'), [
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(6),
            'days' => [
                [
                    'date' => Carbon::now(),
                    'meals' => [
                        [
                            'type' => MealType::BREAKFAST->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::BREAKFAST->value]),
                            ],
                        ],
                        [
                            'type' => MealType::LUNCH->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::LUNCH->value]),
                            ],
                        ],
                        [
                            'type' => MealType::DINNER->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::DINNER->value]),
                            ],
                        ],
                    ],
                ],
                [
                    'date' => Carbon::now()->addDays(1),
                    'meals' => [
                        [
                            'type' => MealType::BREAKFAST->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::BREAKFAST->value]),
                            ],
                        ],
                        [
                            'type' => MealType::LUNCH->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::LUNCH->value]),
                            ],
                        ],
                        [
                            'type' => MealType::DINNER->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::DINNER->value]),
                            ],
                        ],
                    ],
                ],
                [
                    'date' => Carbon::now()->addDays(2),
                    'meals' => [
                        [
                            'type' => MealType::BREAKFAST->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::BREAKFAST->value]),
                            ],
                        ],
                        [
                            'type' => MealType::LUNCH->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::LUNCH->value]),
                            ],
                        ],
                        [
                            'type' => MealType::DINNER->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::DINNER->value]),
                            ],
                        ],
                    ],
                ],
                [
                    'date' => Carbon::now()->addDays(3),
                    'meals' => [
                        [
                            'type' => MealType::BREAKFAST->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::BREAKFAST->value]),
                            ],
                        ],
                        [
                            'type' => MealType::LUNCH->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::LUNCH->value]),
                            ],
                        ],
                        [
                            'type' => MealType::DINNER->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::DINNER->value]),
                            ],
                        ],
                    ],
                ],
                [
                    'date' => Carbon::now()->addDays(4),
                    'meals' => [
                        [
                            'type' => MealType::BREAKFAST->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::BREAKFAST->value]),
                            ],
                        ],
                        [
                            'type' => MealType::LUNCH->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::LUNCH->value]),
                            ],
                        ],
                        [
                            'type' => MealType::DINNER->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::DINNER->value]),
                            ],
                        ],
                    ],
                ],
                [
                    'date' => Carbon::now()->addDays(5),
                    'meals' => [
                        [
                            'type' => MealType::BREAKFAST->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::BREAKFAST->value]),
                            ],
                        ],
                        [
                            'type' => MealType::LUNCH->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::LUNCH->value]),
                            ],
                        ],
                        [
                            'type' => MealType::DINNER->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::DINNER->value]),
                            ],
                        ],
                    ],
                ],
                [
                    'date' => Carbon::now()->addDays(6),
                    'meals' => [
                        [
                            'type' => MealType::BREAKFAST->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::BREAKFAST->value]),
                            ],
                        ],
                        [
                            'type' => MealType::LUNCH->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::LUNCH->value]),
                            ],
                        ],
                        [
                            'type' => MealType::DINNER->value,
                            'recipes' => [
                                Recipe::factory()->create(['type' => RecipeType::DINNER->value]),
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $mealPlan = MealPlan::find(1);
        $this->assertNotNull($mealPlan);

        $redirect = $response->assertRedirect(route('meal-plans.index'));
    }

    public function test_a_meal_plan_has_days(): void
    {
        $mealPlan = MealPlan::factory()->create();
        $days = Day::factory(4)->create([
            'meal_plan_id' => $mealPlan->id,
        ]);

        $queriedMealPlan = MealPlan::with('days')->first();
        $this->assertNotNull($queriedMealPlan);
        $this->assertCount(4, $queriedMealPlan->days);
    }
}
