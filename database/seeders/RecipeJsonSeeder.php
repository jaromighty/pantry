<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class RecipeJsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = File::get(__DIR__.'/../recipe.json');
        $recipeJson = json_decode($file, true);

        $recipe = $this->createRecipe($recipeJson);
        $this->createIngredients($recipeJson, $recipe);
    }

    private function createRecipe(mixed $recipeJson): Recipe
    {
        $recipe = Recipe::create([
            'name' => $recipeJson['title'],
            'type' => $recipeJson['type'],
        ]);

        if ($recipeJson['image'] !== "") {
            $info = pathinfo($recipeJson['image']);
            $contents = file_get_contents($recipeJson['image']);
            $tempFile = '/tmp/' . $info['basename'];
            file_put_contents($tempFile, $contents);
            $recipe->updateImage(new UploadedFile($tempFile, $info['basename']));
        }

        return $recipe;
    }

    private function createIngredients(mixed $recipeJson, Recipe $recipe): void
    {
        foreach ($recipeJson['ingredients'] as $ingredient) {
            $currentIngredient = Ingredient::query()->firstOrCreate([
                'name' => $ingredient['name'],
            ]);
            echo $ingredient['unit'] . PHP_EOL;
            $recipe->ingredients()->attach($currentIngredient, [
                'full_text' => $ingredient['fullText'],
                'unit_id' => null,
                'quantity' => $ingredient['quantity'] !== ''
                    ? (float) $ingredient['quantity']
                    : null,
                'notes' => $ingredient['notes'],
            ]);
        }
    }
}
