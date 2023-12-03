import {type ReactElement} from "react"
import {Head} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {type PageProps} from "@/types";
import {PlusIcon} from "@heroicons/react/24/solid";

export default function SelectRecipes ({ auth }: PageProps): ReactElement {
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
          <li className="col-span-1">
            <div className="bg-orange-50 text-orange-500 p-2 rounded-lg ring-1 ring-orange-200">
              <div className="flex items-center justify-between">
                Breakfast
                <button className="bg-transparent rounded p-1 -my-1 -mx-0.5 hover:bg-orange-200">
                  <PlusIcon className="h-5 w-5 text-orange-500"/>
                </button>
              </div>
            </div>
          </li>
          <li className="col-span-1">
            <div className="bg-blue-50 text-blue-500 p-2 rounded-lg ring-1 ring-blue-200">
              <div className="flex items-center justify-between">
                Lunch
                <button className="bg-transparent rounded p-1 -my-1 -mx-0.5 hover:bg-blue-200">
                  <PlusIcon className="h-5 w-5 text-blue-500"/>
                </button>
              </div>
            </div>
          </li>
          <li className="col-span-1">
            <div className="bg-pink-50 text-pink-500 p-2 rounded-lg ring-1 ring-pink-200">
              <div className="flex items-center justify-between">
                Dinner
                <button className="bg-transparent rounded p-1 -my-1 -mx-0.5 hover:bg-pink-200">
                  <PlusIcon className="h-5 w-5 text-pink-500"/>
                </button>
              </div>
            </div>
          </li>
          <li className="col-span-1">
            <div className="bg-red-50 text-red-500 p-2 rounded-lg ring-1 ring-red-200">
              <div className="flex items-center justify-between">
                Dessert
                <button className="bg-transparent rounded p-1 -my-1 -mx-0.5 hover:bg-red-200">
                  <PlusIcon className="h-5 w-5 text-red-500"/>
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </Authenticated>
  </>
}
