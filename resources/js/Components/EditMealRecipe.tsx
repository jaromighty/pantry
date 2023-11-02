import {ReactElement, useState} from "react";
import {Recipe} from "@/types";
import {classNames} from "@/Utils/classNames";
import {RecipeType} from "@/enums";
import {ArrowPathIcon} from "@heroicons/react/20/solid";
import {router} from "@inertiajs/react";

export default function EditMealRecipe({ mealPlanId, onClose, recipe }: { mealPlanId: number, onClose: () => void, recipe: Recipe }): ReactElement {
  const [selectedRecipe, setSelectedRecipe] = useState<Recipe>(recipe);

  const rotateRecipe = (): void => {
    router.visit(route('meal-plans.edit', {type: recipe.type, meal_plan: mealPlanId}), {
      preserveState: true,
      only: ['recipe'],
      onSuccess: (response): void => {
        setSelectedRecipe(response.props.recipe)
      }
    });
  }

  const updateMealPlan = (): void => {
    router.put(route('meal-plans.update', [mealPlanId]), {
      touch: true,
    }, {
      preserveState: true,
    })
  }

  const submit = () => {
    router.put(route('meals.update', [recipe.pivot.meal_id]), {
      old_recipe_id: recipe.id,
      new_recipe_id: selectedRecipe.id,
    }, {
      preserveState: true,
      onSuccess: () => {
        onClose();
        updateMealPlan();
      },
    })
  }

  return (
    <div className="flex items-center justify-between">
      <p>{selectedRecipe.name}</p>
      <div className="ml-2 flex gap-x-0.5">
        {selectedRecipe.id !== recipe.id && (
          <button onClick={submit} className={classNames(
            'p-1.5 py-1 rounded-md font-medium',
            selectedRecipe.type === RecipeType.BREAKFAST ? 'bg-orange-100 hover:bg-orange-200' : '',
            selectedRecipe.type === RecipeType.LUNCH ? 'bg-blue-100 hover:bg-blue-200' : '',
            selectedRecipe.type === RecipeType.DINNER ? 'bg-pink-100 hover:bg-pink-200' : '',
            selectedRecipe.type === RecipeType.DESSERT ? 'bg-red-100 hover:bg-red-200' : ''
          )}>
            Save
          </button>
        )}
        <button onClick={() => rotateRecipe()} className={classNames(
          'ml-2 p-1 rounded-md',
          selectedRecipe.type === RecipeType.BREAKFAST ? 'hover:bg-orange-200' : '',
          selectedRecipe.type === RecipeType.LUNCH ? 'hover:bg-blue-200' : '',
          selectedRecipe.type === RecipeType.DINNER ? 'hover:bg-pink-200' : '',
          selectedRecipe.type === RecipeType.DESSERT ? 'hover:bg-red-200' : ''
        )}>
          <ArrowPathIcon className="h-5 w-5"/>
        </button>
      </div>
    </div>
  );
}
