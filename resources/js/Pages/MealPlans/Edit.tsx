import {Day, Meal, MealPlan, PageProps} from "@/types";
import {Head, Link, router, useForm} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import dayjs from "dayjs";
import MealCard from "@/Components/Cards/MealCard";
import {useState} from "react";
import Modal from "@/Components/Modal";
import {classNames} from "@/Utils/classNames";
import {MealType} from "@/enums";
import {XMarkIcon} from "@heroicons/react/20/solid";
import EditMealRecipe from "@/Components/EditMealRecipe";

export default function MealPlanEdit ({ auth, hasShoppingList, mealPlan, needsNewShoppingList }: PageProps<{ hasShoppingList:boolean, mealPlan: MealPlan, needsNewShoppingList: boolean }>) {
  const [selectedMeal, setSelectedMeal] = useState<Meal|undefined>(undefined);
  const [updateSelectedMeal, setUpdateSelectedMeal] = useState<boolean>(false);

  const handleMealSelect = (meal: Meal): void => {
    setSelectedMeal(meal);
    setUpdateSelectedMeal(true);
  }

  const {post} = useForm({
    meal_plan_id: mealPlan.id,
  });

  const generate = (): void => {
    post(route('shopping-lists.generate'));
  }

  const regenerate = (): void => {
    router.put(route('shopping-lists.regenerate', {
      shopping_list_id: mealPlan?.shopping_list.id,
      meal_plan_id: mealPlan.id
    }));
  }

  const closeModal = (): void => {
    setUpdateSelectedMeal(false);
  }

  return <>
    <Head title="Edit Meal Plan"/>

    <Authenticated user={auth.user}>
      <div className="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
        <div className="overflow-hidden rounded-lg bg-white shadow divide-y divide-gray-200">
          <header className="flex flex-none items-center justify-between pl-6 pr-4 py-2">
            <h1 className="flex items-center text-base font-semibold leading-6 text-gray-900">
              Meal Plan{' '}
              <span className="flex items-center gap-x-1 ml-2.5 text-gray-500">
                <time dateTime={dayjs(mealPlan.start_date).format('YYYY-MM')}>
                  {dayjs(mealPlan.start_date).format('MMM D, YYYY')}
                </time>
                to
                <time dateTime={dayjs(mealPlan.end_date).format('YYYY-MM')}>
                  {dayjs(mealPlan.end_date).format('MMM D, YYYY')}
                </time>
              </span>
            </h1>
            <div className="ml-4 flex-shrink-0 flex gap-x-1">
              {needsNewShoppingList && hasShoppingList ? (
                <button
                  onClick={regenerate}
                  className="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                >
                  Regenerate shopping list
                </button>
              ) : null}
              {hasShoppingList ? (
                <Link
                  href={route('shopping-lists.show', [mealPlan.shopping_list.id])}
                  className="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                  View shopping list
                </Link>
              ) : (
                <button
                  onClick={generate}
                  className="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                  Generate shopping list
                </button>
              )}
            </div>
          </header>
          <div className="isolate flex flex-auto flex-col overflow-auto bg-white">
            <div style={{ width: '165%' }} className="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full">
              <div className="bg-white shadow ring-1 ring-black ring-opacity-5">
                <div className="hidden grid-cols-7 divide-x divide-gray-100 text-sm leading-6 text-gray-500 sm:grid">
                  {mealPlan.days.map((day: Day, dayIdx: number) => (
                    <div key={dayIdx} className="flex flex-col divide-y divide-gray-100">
                      <div className="flex items-center justify-center py-3">
                        <span>
                          {dayjs(day.date).format('ddd')}{' '}
                          <span className="items-center justify-center font-semibold text-gray-900">
                            {dayjs(day.date).format('D')}
                          </span>
                        </span>
                      </div>
                      <ol className="space-y-2 p-2">
                        {day.meals.map((meal: Meal, mealIdx: number) => (
                          <MealCard key={mealIdx} meal={meal} onClick={() => handleMealSelect(meal)}/>
                        ))}
                      </ol>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Modal maxWidth="lg" show={updateSelectedMeal} onClose={closeModal}>
        <div className="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
          <button
            type="button"
            className={classNames(
              'rounded-md focus:outline-none focus:ring-2 ',
              selectedMeal?.type === MealType.BREAKFAST ? 'text-orange-400 hover:text-orange-500 focus:ring-orange-500' : '',
              selectedMeal?.type === MealType.LUNCH ? 'text-blue-400 hover:text-blue-500 focus:ring-blue-500' : '',
              selectedMeal?.type === MealType.DINNER ? 'text-pink-400 hover:text-pink-500 focus:ring-pink-500' : '',
              selectedMeal?.type === MealType.DESSERT ? 'text-red-400 hover:text-red-500 focus:ring-red-500' : ''
            )}
            onClick={closeModal}
          >
            <span className="sr-only">Close</span>
            <XMarkIcon className="h-6 w-6" aria-hidden="true" />
          </button>
        </div>
        <div className={classNames(
          'p-6',
          selectedMeal?.type === MealType.BREAKFAST ? 'bg-orange-50' : '',
          selectedMeal?.type === MealType.LUNCH ? 'bg-blue-50' : '',
          selectedMeal?.type === MealType.DINNER ? 'bg-pink-50' : '',
          selectedMeal?.type === MealType.DESSERT ? 'bg-red-50' : ''
        )}>
          <h4 className={classNames(
            'text-lg',
            selectedMeal?.type === MealType.BREAKFAST ? 'text-orange-700' : '',
            selectedMeal?.type === MealType.LUNCH ? 'text-blue-700' : '',
            selectedMeal?.type === MealType.DINNER ? 'text-pink-700' : '',
            selectedMeal?.type === MealType.DESSERT ? 'text-red-700' : ''
          )}>
            <span className="font-semibold">{selectedMeal !== undefined && selectedMeal?.type.charAt(0).toUpperCase() + selectedMeal?.type.slice(1)}</span>{' - '}
            <span>{dayjs(selectedMeal?.day.date).format('ddd D')}</span>
          </h4>
          <div className={classNames(
            'mt-6 text-sm',
            selectedMeal?.type === MealType.BREAKFAST ? 'text-orange-600' : '',
            selectedMeal?.type === MealType.LUNCH ? 'text-blue-600' : '',
            selectedMeal?.type === MealType.DINNER ? 'text-pink-600' : '',
            selectedMeal?.type === MealType.DESSERT ? 'text-red-600' : ''
          )}>
            {selectedMeal?.recipes.map((recipe) => (
              <EditMealRecipe mealPlanId={mealPlan.id} recipe={recipe} onClose={closeModal}/>
            ))}
          </div>
        </div>
      </Modal>
    </Authenticated>
  </>;
}
