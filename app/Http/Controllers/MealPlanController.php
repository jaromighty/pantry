<?php

namespace App\Http\Controllers;

use App\Exceptions\RecipeCountLowException;
use App\Models\MealPlan;
use App\Services\MealPlanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        return inertia('MealPlans/Index');
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
    public function store(Request $request)
    {
        MealPlan::create([
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
        ]);

        return redirect()->route('meal-plans.index');
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
    public function edit(MealPlan $mealPlan)
    {
        //
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
