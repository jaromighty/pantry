import {Head, useForm} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {Ingredient, PageProps, Recipe} from "@/types";
import {useState} from "react";

export default function RecipeCreate ({auth}: PageProps) {
  const [newIngredient, setNewIngredient] = useState('');
  const {data, setData, post} = useForm<{ name: string, ingredients: any[] }>({
    name: '',
    ingredients: [],
  });

  const getRandomId = (min: number): number => {
    return min < 1 ? Math.floor(Math.random() + min) : 1;
  }

  const addIngredient = (): void => {
    if (newIngredient === '') {
      return;
    }
    setData('ingredients', [
      ...data.ingredients,
      {
        idx: getRandomId(data.ingredients.length),
        name: newIngredient
      }
    ]);
    setNewIngredient('');
  }

  const submit = (e) => {
    e.preventDefault();

    post(route('recipes.store'));
  }

  return <>
    <Head title="Create new recipe"/>

    <Authenticated user={auth.user}>
      <div className="py-4 max-w-7xl mx-auto px-4 sm:px-6 sm:py-8 lg:px-0">
        <form onSubmit={submit}>
          <div className="space-y-12">
            <div className="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
              <div>
                <h2 className="text-base font-semibold leading-7 text-gray-900">Create new recipe</h2>
                <p className="mt-1 text-sm leading-6 text-gray-600">This is going to be great.</p>
              </div>

              <div className="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                <div className="col-span-full">
                  <label className="block text-sm font-medium leading-6 text-gray-900">
                    Recipe name
                  </label>
                  <div className="mt-2">
                    <input
                      type="text"
                      value={data.name}
                      onChange={(e) => {
                        setData('name', e.target.value)
                      }}
                      className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                  </div>
                </div>

                <div className="col-span-full">
                  <label className="block text-sm font-medium leading-6 text-gray-900">
                    Ingredients
                  </label>
                  <ul
                    role="list"
                    className="mt-2 divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl"
                  >
                    {data.ingredients.length > 0 ? data.ingredients.map((ingredient) => (
                      <li key={ingredient.id} className="relative flex justify-between gap-x-6 p-2 hover:bg-gray-50 sm:px-4">
                        <div className="flex min-w-0 gap-x-4">
                          <div className="min-w-0 flex-auto">
                            <p className="text-sm leading-6 text-gray-900">
                              {ingredient.name}
                            </p>
                          </div>
                        </div>
                      </li>
                    )) : null}
                    <li className="flex bg-white p-2 shadow-xl shadow-indigo-900/5">
                      <input
                        type="text"
                        placeholder="Add an ingredient"
                        value={newIngredient}
                        onChange={(e) => {
                          setNewIngredient(e.target.value)
                        }}
                        className="flex-auto rounded-md bg-transparent pr-2.5 pl-1 py-1 text-base text-slate-900 border-none sm:text-sm placeholder:text-slate-400 focus:outline-none focus:ring-transparent"
                      />
                      <button
                        type="button"
                        onClick={() => addIngredient()}
                        className="rounded-md bg-indigo-600 px-4 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                      >
                        Add
                      </button>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div className="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" className="text-sm font-semibold leading-6 text-gray-900">
              Cancel
            </button>
            <button
              type="submit"
              className="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </Authenticated>
  </>;
}
