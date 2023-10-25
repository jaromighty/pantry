import {Ingredient, PageProps, ShoppingList} from "@/types";
import {Head, router} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";

export default function ShoppingListShow ({ auth, list }: PageProps<{ list: ShoppingList }>) {
  const handleClick = (id: number, action: boolean): void => {
    router.put(route('shopping-lists.update-ingredient', [list]), {
      ingredientId: id,
      action,
    }, {
      preserveScroll: true,
    });
  }

  return <>
    <Head title="Shopping List"/>

    <Authenticated user={auth.user}>
      <div className="py-4 max-w-lg mx-auto px-4 sm:px-6 sm:py-8 lg:px-0">
        <fieldset>
          <legend className="text-base font-semibold leading-6 text-gray-900">Shopping List</legend>
          <div className="mt-2 divide-y divide-gray-200">
            {list.ingredients.map((ingredient: Ingredient, index: number) => (
              <div key={index} className="relative flex items-center p-2">
                <div
                  onClick={() => {
                    handleClick(ingredient.id, !ingredient.pivot.marked)
                  }}
                  className="min-w-0 flex-1 flex items-center gap-x-2 text-sm leading-6"
                >
                  <input
                    type="checkbox"
                    checked={ingredient.pivot.marked}
                    onChange={() => {}}
                    className="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                  />
                  <label className="flex-1 font-medium text-gray-900">
                    {ingredient.name}
                  </label>
                </div>
                <div className="ml-3 flex h-6 items-center"></div>
              </div>
            ))}
          </div>
        </fieldset>
      </div>
    </Authenticated>
  </>;
}
