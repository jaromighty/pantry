import {Day, Meal, MealPlan, PageProps} from "@/types";
import {Head, Link, useForm} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import dayjs from "dayjs";
import MealCard from "@/Components/Cards/MealCard";
import {useState} from "react";

export default function MealPlanEdit ({ auth, hasShoppingList, mealPlan }: PageProps<{ hasShoppingList:boolean, mealPlan: MealPlan }>) {
  const [selectedMeal, setSelectedMeal] = useState<Meal|undefined>(undefined);

  const handleMealSelect = (meal: Meal) => {
    setSelectedMeal(meal);
  }

  const {post} = useForm({
    meal_plan_id: mealPlan.id,
  });

  const submit = () => {
    post(route('shopping-lists.generate'));
  }

  return <>
    <Head title="Edit Meal Plan"/>

    <Authenticated user={auth.user}>
      <div className="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
        <div className="overflow-hidden rounded-lg bg-white shadow divide-y divide-gray-200">
          <header className="flex flex-none items-center justify-between pl-6 pr-4 py-3">
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
            <div className="ml-4 flex-shrink-0">
              {hasShoppingList ? (
                <Link
                  href={route('shopping-lists.show', [mealPlan.shopping_list.id])}
                  className="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                  View shopping list
                </Link>
                ) : (
                <button
                  onClick={submit}
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
    </Authenticated>
  </>;
}
