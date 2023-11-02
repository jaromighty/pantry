<?php

namespace App\Http\Controllers;

use App\Exceptions\MealPlanAlreadyExistsException;
use App\Exceptions\RecipeCountLowException;
use App\Jobs\StoreMealPlan;
use App\Models\MealPlan;
use App\Models\Recipe;
use App\Services\MealPlanService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MealPlanController extends Controller
{
    protected MealPlanService $mealPlanService;

    public function __construct(MealPlanService $mealPlanService)
    {
        $this->mealPlanService = $mealPlanService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('MealPlans/Index', [
            'mealPlans' => MealPlan::orderBy('start_date', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|RedirectResponse
    {
        try {
            $plan = $this->mealPlanService->generate();
            return inertia('MealPlans/Create', [
                'plan' => $plan->toJson(),
            ]);
        } catch (RecipeCountLowException $exception)  {
            return back()->withErrors(['message' => $exception->getMessage()])->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            StoreMealPlan::dispatch($request->all());
            return redirect()->route('meal-plans.index');
        } catch (MealPlanAlreadyExistsException $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MealPlan $mealPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, MealPlan $mealPlan)
    {
        return inertia('MealPlans/Edit', [
            'mealPlan' => $mealPlan->load(['days.meals.recipes', 'days.meals.day', 'shoppingList']),
            'hasShoppingList' => !empty($mealPlan->shoppingList),
            'recipe' => Inertia::lazy(fn () => Recipe::where('type', $request['type'])->inRandomOrder()->first()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MealPlan $mealPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MealPlan $mealPlan)
    {
        //
    }
}
