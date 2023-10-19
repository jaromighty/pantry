<?php

namespace Tests\Feature;

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

        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);
    }

    public function test_a_recipe_can_be_created(): void
    {
        $response = $this->post('/recipes', [
            'name' => 'Tater Tot Casserole',
        ]);

        $response->assertStatus(200);

        $recipe = Recipe::find(1);
        $this->assertNotNull($recipe);
    }
}
