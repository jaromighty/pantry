import {Head, useForm} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {PageProps} from "@/types";

export default function RecipeCreate ({auth}: PageProps) {
  const {data, setData, post} = useForm({
    name: '',
  });

  const submit = (e) => {
    e.preventDefault();

    post(route('recipes.store'));
  }
  return <>
    <Head title="Create new recipe"/>

    <Authenticated user={auth.user}>
      <div className="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
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
