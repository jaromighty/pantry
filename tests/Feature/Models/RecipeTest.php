<?php

namespace Feature\Models;

use App\Enums\RecipeType;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeTest extends TestCase
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

    public function test_a_recipe_can_be_created(): void
    {
        $response = $this->post(route('recipes.store'), [
            'name' => 'Tater Tot Casserole',
            'ingredients' => [
                ['id' => 1, 'name' => 'potatoes'],
                ['id' => 2, 'name' => 'cheese']
            ],
            'type' => [
                'value' =>  RecipeType::DINNER->value
            ],
        ]);

        $redirect = $response->assertRedirect(route('recipes.index'));

        $recipe = Recipe::first();
        $this->assertNotNull($recipe);
    }

    public function test_a_recipe_has_ingredients(): void
    {
        Recipe::factory()->create()->ingredients()->attach(Ingredient::factory(2)->create());

        $queriedRecipe = Recipe::with('ingredients')->first();
        $this->assertNotNull($queriedRecipe);
        $this->assertCount(2, $queriedRecipe->ingredients);
    }
}
