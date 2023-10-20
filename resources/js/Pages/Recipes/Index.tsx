import {PageProps} from "@/types";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {Head} from "@inertiajs/react";
import PrimaryLinkButton from "@/Components/PrimaryLinkButton";

export default function RecipesIndex ({ auth }: PageProps) {
  return <>
    <Head title="Recipes"/>

    <Authenticated user={auth.user}>
      <div className="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
        <div className="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
          <div className="ml-4 mt-2">
            <h3 className="text-base font-semibold leading-6 text-gray-900">
              Our Recipes
            </h3>
          </div>
          <div className="ml-4 mt-2 flex-shrink-0">
            <PrimaryLinkButton href={route('recipes.create')}>
              Create new recipe
            </PrimaryLinkButton>
          </div>
        </div>
      </div>
    </Authenticated>
  </>;
}
