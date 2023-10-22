<?php

namespace Feature\Models;

use App\Enums\MealType;
use App\Models\Meal;
use App\Models\Recipe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MealTest extends TestCase
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

    public function test_a_meal_can_be_created(): void
    {
        $response = $this->post(route('meals.store'), [
            'date' => Carbon::now()->addDays(1),
            'type' => MealType::DINNER->value,
        ]);

        $meal = Meal::first();
        $this->assertNotNull($meal);

        $redirect = $response->assertRedirect(route('meals.index'));
    }

    public function test_a_meal_has_recipes(): void
    {
        Meal::factory()->create()->recipes()->attach(Recipe::factory(2)->create());

        $queriedMeal = Meal::with('recipes')->first();
        $this->assertNotNull($queriedMeal);
        $this->assertCount(2, $queriedMeal->recipes);
    }
}
