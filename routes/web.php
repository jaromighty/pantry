<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('recipes', RecipeController::class);
    Route::post('recipes/switch', [RecipeController::class, 'switch'])->name('recipes.switch');
    Route::resource('ingredients', IngredientController::class);
    Route::resource('meals', MealController::class);
    Route::get('meal-plans/generate', [MealPlanController::class, 'generate'])->name('meal-plans.generate');
    Route::get('meal-plans/select-recipes', [MealPlanController::class, 'selectRecipes'])->name('meal-plan.select-recipes');
    Route::resource('meal-plans', MealPlanController::class);
    Route::post('shopping-lists/generate', [ShoppingListController::class, 'generate'])->name('shopping-lists.generate');
    Route::put('shopping-lists/regenerate', [ShoppingListController::class, 'regenerate'])->name('shopping-lists.regenerate');
    Route::get('shopping-lists/{shoppingList}', [ShoppingListController::class, 'show'])->name('shopping-lists.show');
    Route::put('shopping-lists/{shoppingList}/update-ingredient', [ShoppingListController::class, 'updateShoppingListIngredient'])->name('shopping-lists.update-ingredient');
});

require __DIR__.'/auth.php';
