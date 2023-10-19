<?php

namespace Tests\Feature;

use App\Models\Meal;
use App\Models\MealPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MealMealPlanTest extends TestCase
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

    public function test_a_meal_plan_has_meals(): void
    {
        MealPlan::factory()->create()->meals()->attach(Meal::factory(4)->create());

        $queriedMealPlan = MealPlan::with('meals')->first();
        $this->assertNotNull($queriedMealPlan);
        $this->assertCount(4, $queriedMealPlan->meals);
    }
}
