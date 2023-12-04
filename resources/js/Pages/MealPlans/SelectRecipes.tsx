import {type ReactElement, useState} from "react"
import {Head} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {type PageProps} from "@/types";
import {PlusIcon} from "@heroicons/react/24/solid";
import {MealType} from "@/enums";
import {classNames} from "@/Utils/classNames";
import {bgStyles, buttonStyles, ringStyles, textStyles} from "@/Utils/colors";

interface Meal {
  type: MealType,
  label: string,
  recipes: any[]
}

const mealsArray = [
  { type: MealType.BREAKFAST, label: 'Breakfast', recipes: [] },
  { type: MealType.LUNCH, label: 'Lunch', recipes: [] },
  { type: MealType.DINNER, label: 'Dinner', recipes: [] },
  { type: MealType.DESSERT, label: 'Dessert', recipes: [] },
]

export default function SelectRecipes ({ auth }: PageProps): ReactElement {
  const meals = useState<Meal[]>(mealsArray)

  return <>
    <Head title="Select Recipes"/>

    <Authenticated user={auth.user}>
      <div className="py-8 px-4 max-w-7xl mx-auto sm:px-6">
        <div className="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
          <div className="ml-4 mt-2">
            <h3 className="text-base font-semibold leading-6 text-gray-900">
              Select Recipes
            </h3>
          </div>
          <div className="ml-4 mt-2 flex-shrink-0">

          </div>
        </div>

        <ul role="list" className="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
          {meals[0].map((meal: Meal, index: number) => (
            <li key={index} className="col-span-1">
              <div className={classNames(
                'p-2 rounded-lg',
                bgStyles[meal.type],
                textStyles[meal.type],
                ringStyles[meal.type]
              )}>
                <div className="flex items-center justify-between">
                  {meal.label}
                  <button className={classNames(
                    'bg-transparent rounded p-1 -my-1 -mx-0.5',
                    buttonStyles[meal.type]
                  )}>
                    <PlusIcon className="h-5 w-5"/>
                  </button>
                </div>
              </div>
            </li>
          ))}
        </ul>
      </div>
    </Authenticated>
  </>
}
