<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientRecipeTest extends TestCase
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

    public function test_a_recipe_has_ingredients(): void
    {
        Recipe::factory()->create()->ingredients()->attach(Ingredient::factory(2)->create());

        $queriedRecipe = Recipe::with('ingredients')->first();
        $this->assertNotNull($queriedRecipe);
        $this->assertCount(2, $queriedRecipe->ingredients);
    }
}
