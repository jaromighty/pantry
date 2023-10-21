import {Head, useForm} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {PageProps, Recipe} from "@/types";
import {Fragment, useState} from "react";
import {Listbox, Transition} from "@headlessui/react";
import {CheckIcon, ChevronUpDownIcon} from "@heroicons/react/24/solid";
import {classNames} from "@/Utils/classNames";

interface RecipeType {
  id: number
  name: string
  value: string
}
const types: RecipeType[] = [
  { id: 1, name: 'Breakfast', value: 'breakfast' },
  { id: 1, name: 'Lunch', value: 'lunch' },
  { id: 1, name: 'Snack', value: 'snack' },
  { id: 1, name: 'Dinner', value: 'dinner' },
  { id: 1, name: 'Dessert', value: 'dessert' },
];

export default function RecipeEdit ({ auth, recipe }: PageProps<{ recipe: Recipe }>) {
  const [newIngredient, setNewIngredient] = useState('');
  const {data, setData, put} = useForm({
    name: recipe.name,
    ingredients: recipe.ingredients.map(i => ({
      idx: i.id,
      type: types.find(type => type.value === recipe.type),
      name: i.name,
    })),
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

    put(route('recipes.update', [recipe]));
  }

  return <>
    <Head title={`Edit ${recipe.name}`}/>

    <Authenticated user={auth.user}>
      <div className="py-4 max-w-7xl mx-auto px-4 sm:px-6 sm:py-8 lg:px-0">
        <form onSubmit={submit}>
          <div className="space-y-12">
            <div className="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
              <div>
                <h2 className="text-base font-semibold leading-7 text-gray-900">Edit recipe</h2>
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
                  <Listbox value={data.type} onChange={(value) => setData('type', value)}>
                    {({ open }) => (
                      <>
                        <Listbox.Label className="block text-sm font-medium leading-6 text-gray-900">Recipe type</Listbox.Label>
                        <div className="relative mt-2">
                          <Listbox.Button className="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <span className="block truncate">{data.type ? data.type.name : 'Select a recipe type'}</span>
                            <span className="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                              <ChevronUpDownIcon className="h-5 w-5 text-gray-400" aria-hidden="true" />
                            </span>
                          </Listbox.Button>

                          <Transition
                            show={open}
                            as={Fragment}
                            leave="transition ease-in duration-100"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0"
                          >
                            <Listbox.Options className="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                              {types.map((type) => (
                                <Listbox.Option
                                  key={type.id}
                                  className={({ active }) =>
                                    classNames(
                                      active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                                      'relative cursor-default select-none py-2 pl-3 pr-9'
                                    )
                                  }
                                  value={type}
                                >
                                  {({ selected, active }) => (
                                    <>
                                      <span className={classNames(selected ? 'font-semibold' : 'font-normal', 'block truncate')}>
                                        {type.name}
                                      </span>

                                      {selected ? (
                                        <span
                                          className={classNames(
                                            active ? 'text-white' : 'text-indigo-600',
                                            'absolute inset-y-0 right-0 flex items-center pr-4'
                                          )}
                                        >
                                          <CheckIcon className="h-5 w-5" aria-hidden="true" />
                                        </span>
                                      ) : null}
                                    </>
                                  )}
                                </Listbox.Option>
                              ))}
                            </Listbox.Options>
                          </Transition>
                        </div>
                      </>
                    )}
                  </Listbox>
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
