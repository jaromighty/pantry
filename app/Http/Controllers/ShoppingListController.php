<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Services\ShoppingListService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class ShoppingListController extends Controller
{
    protected ShoppingListService $shoppingListService;

    public function __construct(ShoppingListService $shoppingListService)
    {
        $this->shoppingListService = $shoppingListService;
    }

    public function generate(Request $request): RedirectResponse
    {
        $list = $this->shoppingListService->generate($request['meal_plan_id']);

        return redirect()->route('shopping-lists.show', [$list]);
    }

    public function show(ShoppingList $shoppingList): Response
    {
        return inertia('ShoppingLists/Show', [
            'list' => $shoppingList->load('ingredients'),
        ]);
    }

    public function updateShoppingListIngredient(Request $request, ShoppingList $shoppingList): RedirectResponse
    {
        $shoppingList->ingredients()->updateExistingPivot($request['ingredientId'], [
            'marked' => $request['action'],
        ]);

        return back();
    }
}
