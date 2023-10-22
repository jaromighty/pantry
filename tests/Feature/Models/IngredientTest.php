<?php

namespace Feature\Models;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientTest extends TestCase
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

    public function test_an_ingredient_can_be_created(): void
    {
        $response = $this->post('/ingredients', [
            'name' => 'Tater Tots',
        ]);

        $response->assertRedirectToRoute('ingredients.index');

        $ingredient = Ingredient::find(1);
        $this->assertNotNull($ingredient);
    }
}
