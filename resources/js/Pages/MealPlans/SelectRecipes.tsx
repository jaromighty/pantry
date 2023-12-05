import {Fragment, type ReactElement, useState} from "react"
import {Head, router} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {type PageProps, Recipe} from "@/types";
import {PlusIcon} from "@heroicons/react/24/solid";
import {MealType} from "@/enums";
import {classNames} from "@/Utils/classNames";
import {bgStyles, buttonStyles, ringStyles, textStyles} from "@/Utils/colors";
import {Combobox, Dialog, Transition} from "@headlessui/react";

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

export default function SelectRecipes ({ auth, recipes }: PageProps<{ recipes?: Recipe[] }>): ReactElement {
  const [meals, setMeals] = useState<Meal[]>(mealsArray)
  const [query, setQuery] = useState<string>('')
  const [open, setOpen] = useState<boolean>(false)

  const search = (value: string) => {
    setQuery(value)
    router.visit(route('meal-plans.select-recipes', {search: value}), {
      preserveState: true,
      only: ['recipes']
    })
  }

  const add = (recipe: Recipe): void => {
    let updatedMeals = meals
    let mealIndex = updatedMeals.findIndex(meal => meal.type.toString() === recipe.type.toString())
    updatedMeals[mealIndex].recipes.push(recipe)
    setMeals(updatedMeals)
    setOpen(false)
  }

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
          {meals.map((meal: Meal, index: number) => (
            <li key={index} className="col-span-1">
              <div className={classNames(
                'p-2 rounded-lg',
                bgStyles[meal.type],
                textStyles[meal.type],
                ringStyles[meal.type]
              )}>
                <div className="flex items-center justify-between">
                  {meal.label}
                  <button
                    onClick={() => setOpen(true)}
                    className={classNames(
                      'bg-transparent rounded p-1 -my-1 -mx-0.5',
                      buttonStyles[meal.type]
                    )}
                  >
                    <PlusIcon className="h-5 w-5"/>
                  </button>
                </div>
              </div>

              <ul role="list" className="mt-4 space-y-3">
                {meal.recipes.map((recipe) => (
                  <li key={recipe.id} className="overflow-hidden rounded-lg bg-white px-3 py-2 shadow">
                    {recipe.name}
                  </li>
                ))}
              </ul>
            </li>
          ))}
        </ul>
      </div>

      <Transition.Root show={open} as={Fragment} afterLeave={() => setQuery('')} appear>
        <Dialog as="div" className="relative z-10" onClose={setOpen}>
          <Transition.Child
            as={Fragment}
            enter="ease-out duration-300"
            enterFrom="opacity-0"
            enterTo="opacity-100"
            leave="ease-in duration-200"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
          >
            <div className="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity" />
          </Transition.Child>

          <div className="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
            <Transition.Child
              as={Fragment}
              enter="ease-out duration-300"
              enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              enterTo="opacity-100 translate-y-0 sm:scale-100"
              leave="ease-in duration-200"
              leaveFrom="opacity-100 translate-y-0 sm:scale-100"
              leaveTo="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
              <Dialog.Panel className="mx-auto max-w-xl transform rounded-xl bg-white p-2 shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
                <Combobox onChange={(recipe) => add(recipe)}>
                  <Combobox.Input
                    className="w-full rounded-md border-0 bg-gray-100 px-4 py-2.5 text-gray-900 focus:ring-0 sm:text-sm"
                    placeholder="Search..."
                    onChange={(event) => search(event.target.value)}
                  />

                  {recipes?.length > 0 && (
                    <Combobox.Options
                      static
                      className="-mb-2 max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800"
                    >
                      {recipes.map((recipe) => (
                        <Combobox.Option
                          key={recipe.id}
                          value={recipe}
                          className={({ active }) =>
                            classNames(
                              'cursor-default select-none rounded-md px-4 py-2',
                              active ? 'bg-indigo-600 text-white' : ''
                            )
                          }
                        >
                          {recipe.name}
                        </Combobox.Option>
                      ))}

                      {query !== '' && recipes.length === 0 && (
                        <div className="px-4 py-14 text-center sm:px-14">
                          <p className="mt-4 text-sm text-gray-900">No recipe found using that search term.</p>
                        </div>
                      )}
                    </Combobox.Options>
                  )}
                </Combobox>
              </Dialog.Panel>
            </Transition.Child>
          </div>
        </Dialog>
      </Transition.Root>
    </Authenticated>
  </>
}
