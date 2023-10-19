<?php

namespace Tests\Feature;

use App\Models\MealPlan;
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
        ]);

        $mealPlan = MealPlan::find(1);
        $this->assertNotNull($mealPlan);

        $redirect = $response->assertRedirect(route('meal-plans.index'));
    }
}
