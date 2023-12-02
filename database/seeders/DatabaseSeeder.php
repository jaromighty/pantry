<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RecipeType;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // USER
        User::create([
            'name' => env('APP_USER_NAME'),
            'email' => env('APP_USER_EMAIL'),
            'password' => Hash::make('password'),
        ]);

        // BREAKFAST
        $recipeA = Recipe::create([
            'name' => 'Healthy Peanut Butter Banana Muffins',
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ([
            ['name' => 'Bananas'],
            ['name' => 'Maple syrup'],
            ['name' => 'Plain greek yogurt'],
            ['name' => 'Eggs'],
            ['name' => 'Whole milk'],
            ['name' => 'Creamy peanut butter'],
            ['name' => 'Vanilla extract'],
            ['name' => 'Whole wheat flour'],
            ['name' => 'Cinnamon'],
            ['name' => 'Baking soda'],
            ['name' => 'Baking powder'],
            ['name' => 'Salt'],
        ] as $ingredient) {
            $recipeA->ingredients()->firstOrCreate($ingredient);
        }

        $recipeB = Recipe::create([
            'name' => 'Eggs and Toast',
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ([
            ['name' => 'Eggs'],
            ['name' => 'Bread'],
            ['name' => 'Butter'],
            ['name' => 'Fruit jam'],
        ] as $ingredient) {
            $recipeB->ingredients()->firstOrCreate($ingredient);
        }

        $recipeC = Recipe::create([
            'name' => 'Peach Oatmeal',
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ([
            ['name' => 'Oatmeal'],
            ['name' => 'Water'],
            ['name' => 'Salt'],
            ['name' => 'Peaches'],
        ] as $ingredient) {
            $recipeC->ingredients()->firstOrCreate($ingredient);
        }

        $recipeD = Recipe::create([
            'name' => 'Ricotta Pancakes',
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ([
            ['name' => 'All-Purpose flour'],
            ['name' => 'Baking powder'],
            ['name' => 'Salt'],
            ['name' => 'Ricotta cheese'],
            ['name' => 'Buttermilk'],
            ['name' => 'Eggs'],
            ['name' => 'Maple syrup'],
            ['name' => 'Vanilla extract'],
        ] as $ingredient) {
            $recipeD->ingredients()->firstOrCreate($ingredient);
        }

        $recipeE = Recipe::create([
            'name' => 'Swiss oatmeal',
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ([
            ['name' => 'Oatmeal'],
            ['name' => 'Yogurt'],
            ['name' => 'Salt'],
            ['name' => 'Whole milk'],
            ['name' => 'Blueberries'],
            ['name' => 'Vanilla extract'],
        ] as $ingredient) {
            $recipeE->ingredients()->firstOrCreate($ingredient);
        }

        $recipeF = Recipe::create([
            'name' => 'Overnight Peach French Toast',
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ([
            ['name' => 'French bread'],
            ['name' => 'Peaches'],
            ['name' => 'Salt'],
            ['name' => 'Heavy cream'],
            ['name' => 'Maple syrup'],
            ['name' => 'Vanilla extract'],
        ] as $ingredient) {
            $recipeF->ingredients()->firstOrCreate($ingredient);
        }

        $recipeG = Recipe::create([
            'name' => 'Turkey Ranch Club Wraps',
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ([
            ['name' => 'Tortillas'],
            ['name' => 'Smoked turkey breast'],
            ['name' => 'Cheddar cheese'],
            ['name' => 'Bacon'],
            ['name' => 'Ranch dressing'],
            ['name' => 'Sliced tomatoes'],
        ] as $ingredient) {
            $recipeG->ingredients()->firstOrCreate($ingredient);
        }

        $recipeH = Recipe::create([
            'name' => 'Blackberry Bacon Grilled Cheese',
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ([
            ['name' => 'Butter'],
            ['name' => 'Sourdough bread'],
            ['name' => 'Swiss cheese'],
            ['name' => 'Bacon'],
            ['name' => 'Blackberry jam'],
        ] as $ingredient) {
            $recipeH->ingredients()->firstOrCreate($ingredient);
        }

        $recipeI = Recipe::create([
            'name' => 'Bacon Guacamole Grilled Cheese',
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ([
            ['name' => 'Butter'],
            ['name' => 'Sourdough bread'],
            ['name' => 'Cheddar cheese'],
            ['name' => 'Guacamole'],
            ['name' => 'Bacon'],
        ] as $ingredient) {
            $recipeI->ingredients()->firstOrCreate($ingredient);
        }

        $recipeJ = Recipe::create([
            'name' => 'Turkey Taco Lettuce Wraps',
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ([
            ['name' => 'Ground turkey'],
            ['name' => 'Garlic powder'],
            ['name' => 'Cumin'],
            ['name' => 'Salt'],
            ['name' => 'Chili powder'],
            ['name' => 'Paprika'],
            ['name' => 'Oregano'],
            ['name' => 'Onion'],
            ['name' => 'Bell pepper'],
        ] as $ingredient) {
            $recipeJ->ingredients()->firstOrCreate($ingredient);
        }

        $recipeK = Recipe::create([
            'name' => 'Avocado Egg Salad',
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ([
            ['name' => 'Eggs'],
            ['name' => 'Mayonnaise'],
            ['name' => 'Plain greek yogurt'],
            ['name' => 'Dijon mustard'],
            ['name' => 'Lemon'],
            ['name' => 'White wine vinegar'],
            ['name' => 'Avocado'],
            ['name' => 'Bread'],
            ['name' => 'Tomato'],
        ] as $ingredient) {
            $recipeK->ingredients()->firstOrCreate($ingredient);
        }

        $recipeL = Recipe::create([
            'name' => 'Mortadella, Artichoke, and Sun-Dried Tomato Kebabs',
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ([
            ['name' => 'Mortadella'],
            ['name' => 'Marinated artichoke hearts'],
            ['name' => 'Sun-dried tomatoes'],
            ['name' => 'Olives'],
            ['name' => 'Basil'],
            ['name' => 'Bread'],
            ['name' => 'Pesto'],
            ['name' => 'Lemon'],
        ] as $ingredient) {
            $recipeL->ingredients()->firstOrCreate($ingredient);
        }

        $recipeM = Recipe::create([
            'name' => 'Chicken Shawarma',
            'type' => RecipeType::LUNCH->value,
        ]);
        foreach ([
            ['name' => 'Chicken'],
            ['name' => 'Olive oil'],
            ['name' => 'Lemon'],
            ['name' => 'Garlic powder'],
            ['name' => 'Cumin'],
            ['name' => 'Coriander'],
            ['name' => 'Paprika'],
        ] as $ingredient) {
            $recipeM->ingredients()->firstOrCreate($ingredient);
        }

        $recipeN = Recipe::create([
            'name' => 'Breakfast Sandwich',
            'type' => RecipeType::BREAKFAST->value,
        ]);
        foreach ([
            ['name' => 'Tortillas'],
            ['name' => 'Eggs'],
            ['name' => 'Ground sausage'],
            ['name' => 'Cheese'],
        ] as $ingredient) {
            $recipeN->ingredients()->firstOrCreate($ingredient);
        }

        // DINNER
        $recipeO = Recipe::create([
            'name' => 'Creamy Tortellini with Spinach & Tomatoes',
            'type' => RecipeType::DINNER->value,
        ]);
        foreach ([
            ['name' => 'Tortellini'],
            ['name' => 'Garlic'],
            ['name' => 'Spinach'],
            ['name' => 'Diced Tomatoes'],
            ['name' => 'Salt'],
            ['name' => 'Basil'],
            ['name' => 'All-purpose flour'],
            ['name' => 'Heavy cream'],
            ['name' => 'Parmesan cheese'],
        ] as $ingredient) {
            $recipeO->ingredients()->firstOrCreate($ingredient);
        }

        $recipeP = Recipe::create([
            'name' => 'Black Bean Taco Soup',
            'type' => RecipeType::DINNER->value,
        ]);
        foreach ([
            ['name' => 'Ground beef'],
            ['name' => 'Onion'],
            ['name' => 'Taco seasoning'],
            ['name' => 'Frozen corn'],
            ['name' => 'Black beans'],
            ['name' => 'Diced tomatoes'],
            ['name' => 'Tomato sauce'],
            ['name' => 'Diced green chiles'],
            ['name' => 'Tortilla chips'],
            ['name' => 'Cheddar cheese'],
        ] as $ingredient) {
            $recipeP->ingredients()->firstOrCreate($ingredient);
        }

        $recipeQ = Recipe::create([
            'name' => 'Honey Lime Chicken Enchiladas',
            'type' => RecipeType::DINNER->value,
        ]);
        foreach ([
            ['name' => 'Honey'],
            ['name' => 'Lime juice'],
            ['name' => 'Chili powder'],
            ['name' => 'Garlic powder'],
            ['name' => 'Chicken'],
            ['name' => 'Diced tomatoes'],
            ['name' => 'Green enchilada sauce'],
            ['name' => 'Diced green chiles'],
            ['name' => 'Heavy cream'],
            ['name' => 'Cheddar cheese'],
        ] as $ingredient) {
            $recipeQ->ingredients()->firstOrCreate($ingredient);
        }

        $recipeR = Recipe::create([
            'name' => 'Kielbasa Pasta Salad',
            'type' => RecipeType::DINNER->value,
        ]);
        foreach ([
            ['name' => 'Bowtie pasta'],
            ['name' => 'Mayonnaise'],
            ['name' => 'Italian dressing mix'],
            ['name' => 'Kielbasa sausage'],
            ['name' => 'Olives'],
            ['name' => 'Parmesan cheese'],
            ['name' => 'Apple cider vinegar'],
        ] as $ingredient) {
            $recipeR->ingredients()->firstOrCreate($ingredient);
        }

        $recipeS = Recipe::create([
            'name' => 'One Pot Taco Spaghetti',
            'type' => RecipeType::DINNER->value,
        ]);
        foreach ([
            ['name' => 'Olive oil'],
            ['name' => 'Ground beef'],
            ['name' => 'Tomato paste'],
            ['name' => 'Spaghetti'],
            ['name' => 'Cheddar cheese'],
            ['name' => 'Mozzarella cheese'],
            ['name' => 'Roma tomato'],
        ] as $ingredient) {
            $recipeS->ingredients()->firstOrCreate($ingredient);
        }

        $recipeT = Recipe::create([
            'name' => 'Chicken Enchilada Pasta',
            'type' => RecipeType::DINNER->value,
        ]);
        foreach ([
            ['name' => 'Olive oil'],
            ['name' => 'Chicken'],
            ['name' => 'Onion'],
            ['name' => 'Diced green chiles'],
            ['name' => 'Salt'],
            ['name' => 'Chili powder'],
            ['name' => 'Cumin'],
            ['name' => 'Marinara'],
            ['name' => 'Colby jack cheese'],
            ['name' => 'Sour cream'],
            ['name' => 'Penne'],
        ] as $ingredient) {
            $recipeT->ingredients()->firstOrCreate($ingredient);
        }

        // DESSERT
        $recipeU = Recipe::create([
            'name' => 'Strawberry Cheesecake Salad',
            'type' => RecipeType::DESSERT->value,
        ]);
        foreach ([
            ['name' => 'Cheesecake pudding mix'],
            ['name' => 'Whipped topping'],
            ['name' => 'Strawberry yogurt'],
            ['name' => 'Strawberries'],
            ['name' => 'Bananas'],
            ['name' => 'Mini marshmallows'],
        ] as $ingredient) {
            $recipeU->ingredients()->firstOrCreate($ingredient);
        }
    }
}
