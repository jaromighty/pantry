import {Head} from "@inertiajs/react";
import {PageProps, Recipe} from "@/types";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {Button} from "@/Components/button";

export default function RecipeShow ({ auth, recipe }: PageProps<{ recipe: Recipe }>) {
  return <>
    <Head title={recipe.name}/>

    <Authenticated user={auth.user}>
      <div className="py-4 max-w-7xl mx-auto sm:px-6 sm:py-8 lg:px-0">
        <div className="overflow-hidden bg-white shadow sm:max-w-5xl sm:mx-auto sm:rounded-2xl">
          <div className="px-4 py-5 sm:p-8">
            <div className="flex">
              <div className="mr-6 flex-shrink-0">
                <img
                  className="inline-block size-32 rounded-xl"
                  src={recipe.image_url}
                  alt=""
                />
              </div>
              <div className="w-full sm:flex sm:justify-between">
                <h4 className="text-3xl font-bold sm:flex-1">{recipe.name}</h4>
                <div className="mt-3 sm:ml-4 sm:mt-0">
                  <Button color="indigo" href={route('recipes.edit', [recipe])}>
                    Edit Recipe
                  </Button>
                </div>
              </div>
            </div>

            <div className="mt-8 sm:grid sm:grid-cols-3 sm:gap-6">
              <div className="sm:col-span-1">
                <h4 className="font-semibold text-2xl">
                  Ingredients
                </h4>
                <ul className="mt-2 divide-y divide-gray-200">
                  {recipe.ingredients.map((ingredient) => (
                    <li className="py-2">{ingredient.name}</li>
                  ))}
                </ul>
              </div>
              <div className="mt-6 sm:col-span-2 sm:mt-0">
                <h4 className="font-semibold text-2xl">
                  Directions
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Authenticated>
  </>;
}
