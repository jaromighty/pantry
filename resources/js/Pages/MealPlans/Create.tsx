import {PageProps} from "@/types";
import {Head} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {useState} from "react";
import dayjs from "dayjs";
import {classNames} from "@/Utils/classNames";
import {MealType} from "@/enums";

export default function MealPlanCreate ({ auth, plan }: PageProps<{ plan: string }>) {
  const [mealPlan] = useState(JSON.parse(plan));

  return <>
    <Head title="Create A Meal Plan"/>

    <Authenticated user={auth.user}>
      <div className="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">

        <div className="overflow-hidden rounded-lg bg-white shadow divide-y divide-gray-200">
          <header className="flex flex-none items-center justify-between px-6 py-4">
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
          </header>
          <div className="isolate flex flex-auto flex-col overflow-auto bg-white">
            <div style={{ width: '165%' }} className="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full">
              <div className="bg-white shadow ring-1 ring-black ring-opacity-5">
                <div className="hidden grid-cols-7 divide-x divide-gray-100 text-sm leading-6 text-gray-500 sm:grid">
                  {mealPlan.days.map((day) => (
                    <div className="flex flex-col divide-y divide-gray-100">
                      <div className="flex items-center justify-center py-3">
                        <span>
                          {dayjs(day.date).format('ddd')}{' '}
                          <span className="items-center justify-center font-semibold text-gray-900">
                            {dayjs(day.date).format('D')}
                          </span>
                        </span>
                      </div>
                      <ol className="space-y-2 p-2">
                        {day.meals.map((meal) => (
                          <li>
                            <div className={classNames(
                              'group flex flex-col overflow-y-auto rounded-md p-2 text-xs leading-5',
                              meal.type === MealType.BREAKFAST ? 'bg-orange-50 hover:bg-orange-100' : '',
                              meal.type === MealType.LUNCH ? 'bg-blue-50 hover:bg-blue-100' : '',
                              meal.type === MealType.DINNER ? 'bg-pink-50 hover:bg-pink-100' : '',
                              meal.type === MealType.DESSERT ? 'bg-red-50 hover:bg-red-100' : ''
                            )}>
                              <p className={classNames(
                                'order-1 font-semibold text-blue-700',
                                meal.type === MealType.BREAKFAST ? 'text-orange-700' : '',
                                meal.type === MealType.LUNCH ? 'text-blue-700' : '',
                                meal.type === MealType.DINNER ? 'text-pink-700' : '',
                                meal.type === MealType.DESSERT ? 'text-red-700' : ''
                              )}>
                                {meal.recipes[0].name}
                              </p>
                              <p className={classNames(
                                meal.type === MealType.BREAKFAST ? 'text-orange-500 group-hover:text-orange-700' : '',
                                meal.type === MealType.LUNCH ? 'text-blue-500 group-hover:text-blue-700' : '',
                                meal.type === MealType.DINNER ? 'text-pink-500 group-hover:text-pink-700' : '',
                                meal.type === MealType.DESSERT ? 'text-red-500 group-hover:text-red-700' : ''
                              )}>
                                {meal.type.charAt(0).toUpperCase() + meal.type.slice(1)}
                              </p>
                            </div>
                          </li>
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
