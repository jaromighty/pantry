<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Inertia\Response;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Recipes/Index', [
            'recipes' => Recipe::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Recipes/Create');
    }

    public function import(Request $request): Response
    {
        return inertia('Recipes/Import', [
            'url' => $request['url'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $recipe = Recipe::create([
            'name' => $request['name'],
            'type' => $request['type']['value'],
        ]);

        foreach ($request['ingredients'] as $ingredient) {
            unset($ingredient['idx']);
            $recipe->ingredients()->firstOrCreate($ingredient);
        }

        return redirect()->route('recipes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return inertia('Recipes/Show', [
            'recipe' => $recipe->load('ingredients'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return inertia('Recipes/Edit', [
            'recipe' => $recipe->load('ingredients'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->update([
            'name' => $request['name'],
            'type' => $request['type']['value'],
        ]);

        foreach ($request['ingredients'] as $ingredient) {
            unset($ingredient['idx']);
            $recipe->ingredients()->firstOrCreate($ingredient);
        }

        return redirect()->route('recipes.show', [$recipe]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }

    public function switch(Request $request)
    {
        $recipe = Recipe::where('type', $request['type'])->inRandomOrder()->first();

        return back()->with(['recipe' => $recipe]);
    }
}
