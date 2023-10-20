import {Head} from "@inertiajs/react";
import {PageProps, Recipe} from "@/types";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import PrimaryLinkButton from "@/Components/PrimaryLinkButton";

export default function RecipeShow ({ auth, recipe }: PageProps<{ recipe: Recipe }>) {
  return <>
    <Head title={recipe.name}/>

    <Authenticated user={auth.user}>
      <div className="py-4 max-w-7xl mx-auto px-4 sm:px-6 sm:py-8 lg:px-0">
        <div className="overflow-hidden rounded-lg bg-white shadow">
          <div className="border-b border-gray-200 p-4 sm:px-6 sm:py-5">
            <div className="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
              <div className="ml-4 mt-2">
                <h3 className="text-base font-semibold leading-6 text-gray-900">
                  {recipe.name}
                </h3>
              </div>
              <div className="ml-4 mt-2 flex-shrink-0">
                <PrimaryLinkButton href={route('recipes.edit', [recipe])}>
                  Edit recipe
                </PrimaryLinkButton>
              </div>
            </div>
          </div>
          <div className="px-4 py-5 sm:p-6">
            <div className="mx-auto max-w-2xl lg:mx-0 lg:grid lg:max-w-none lg:grid-cols-2 lg:gap-x-16 lg:gap-y-6 xl:grid-cols-1 xl:grid-rows-1 xl:gap-x-8">
              <div className="mt-6 max-w-xl lg:mt-0 xl:col-end-1 xl:row-start-1">
                <p className="text-lg leading-8 text-gray-600">
                  Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet
                  fugiat veniam occaecat fugiat aliqua. Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui
                  lorem cupidatat commodo.
                </p>
              </div>
              <img
                src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?auto=format&fit=crop&q=80&w=1547&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt=""
                className="mt-10 aspect-[6/5] w-full max-w-lg rounded-2xl object-cover lg:mt-0 lg:max-w-none xl:row-span-2 xl:row-end-2"
              />
            </div>
          </div>
        </div>
      </div>
    </Authenticated>
  </>;
}
