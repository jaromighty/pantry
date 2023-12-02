import {Head, Link} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {PageProps} from "@/types";
import PrimaryLinkButton from "@/Components/PrimaryLinkButton";
import dayjs from "dayjs";
import {ChevronRightIcon} from "@heroicons/react/20/solid";

export default function MealPlanIndex ({ auth, mealPlans }: PageProps<{ mealPlans: any[] }>) {
  return <>
    <Head title="Meal Plans"/>

    <Authenticated user={auth.user}>
      <div className="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
        <div className="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
          <div className="ml-4 mt-2">
            <h3 className="text-base font-semibold leading-6 text-gray-900">
              Our Meal Plans
            </h3>
          </div>
          <div className="ml-4 mt-2 flex-shrink-0">
            <PrimaryLinkButton href={route('meal-plans.generate')}>
              Generate new meal plan
            </PrimaryLinkButton>
          </div>
        </div>

        {mealPlans.length > 0 && (
          <ul
            role="list"
            className="mt-4 divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl"
          >
            {mealPlans.map((mealPlan) => (
              <li key={mealPlan.id} className="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">
                <div className="flex min-w-0 gap-x-4">
                  {/*<img className="h-12 w-12 flex-none rounded-full bg-gray-50" src={mealPlan.imageUrl} alt="" />*/}
                  <div className="min-w-0 flex-auto">
                    <p className="text-sm font-semibold leading-6 text-gray-900">
                      <Link href={route('meal-plans.edit', [mealPlan])} className="flex gap-x-1">
                        <span className="absolute inset-x-0 -top-px bottom-0" />
                        <time dateTime={dayjs(mealPlan.start_date).format('YYYY-MM')}>
                          {dayjs(mealPlan.start_date).format('MMM D, YYYY')}
                        </time>
                        to
                        <time dateTime={dayjs(mealPlan.end_date).format('YYYY-MM')}>
                          {dayjs(mealPlan.end_date).format('MMM D, YYYY')}
                        </time>
                      </Link>
                    </p>
                    {/*<p className="mt-1 flex text-xs leading-5 text-gray-500">*/}
                    {/*  <a href={`mailto:${mealPlan.email}`} className="relative truncate hover:underline">*/}
                    {/*    {mealPlan.email}*/}
                    {/*  </a>*/}
                    {/*</p>*/}
                  </div>
                </div>
                <div className="flex shrink-0 items-center gap-x-4">
                  {/*<div className="hidden sm:flex sm:flex-col sm:items-end">*/}
                  {/*  <p className="text-sm leading-6 text-gray-900">{mealPlan.role}</p>*/}
                  {/*  {mealPlan.lastSeen ? (*/}
                  {/*    <p className="mt-1 text-xs leading-5 text-gray-500">*/}
                  {/*      Last seen <time dateTime={mealPlan.lastSeenDateTime}>{mealPlan.lastSeen}</time>*/}
                  {/*    </p>*/}
                  {/*  ) : (*/}
                  {/*    <div className="mt-1 flex items-center gap-x-1.5">*/}
                  {/*      <div className="flex-none rounded-full bg-emerald-500/20 p-1">*/}
                  {/*        <div className="h-1.5 w-1.5 rounded-full bg-emerald-500" />*/}
                  {/*      </div>*/}
                  {/*      <p className="text-xs leading-5 text-gray-500">Online</p>*/}
                  {/*    </div>*/}
                  {/*  )}*/}
                  {/*</div>*/}
                  <ChevronRightIcon className="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                </div>
              </li>
            ))}
          </ul>
        )}
      </div>
    </Authenticated>
  </>;
}
