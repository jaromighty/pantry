import {PageProps, Recipe} from "@/types";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {Head, Link, useForm} from "@inertiajs/react";
import {Button} from "@/Components/button";
import {Dialog, DialogBody, DialogTitle} from "@/Components/dialog";
import {useState} from "react";
import {Field, Fieldset, Label} from "@/Components/fieldset";
import {Input} from "@/Components/input";

export default function RecipesIndex ({ auth, recipes }: PageProps<{ recipes: Recipe[] }>) {
  const [open, setOpen] = useState(false)
  const [confirmUrl, setConfirmUrl] = useState(false)

  const {data, setData} = useForm({
    url: ''
  })

  const onClose = () => {
    setOpen(false)
    setTimeout(() => {
      setConfirmUrl(false)
    }, 1000)
  }

  return (
    <Authenticated user={auth.user}>
      <Head title="Recipes"/>

      <div className="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
        <div className="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
          <div className="ml-4 mt-2">
            <h3 className="text-base font-semibold leading-6 text-gray-900">
              Our Recipes
            </h3>
          </div>
          <div className="ml-4 mt-2 flex-shrink-0">
            <Button color="indigo" onClick={() => setOpen(true)}>
              Create new recipe
            </Button>
          </div>
        </div>

        <div className="mt-8">
          <ul role="list" className="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-5 xl:gap-x-8">
            {recipes.map((recipe) => (
              <li key={recipe.id} className="relative">
                <div className="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                  <img src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?auto=format&fit=crop&q=80&w=1547&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" className="pointer-events-none object-cover group-hover:opacity-75" />
                  <Link href={route('recipes.show', [recipe])} className="absolute inset-0 focus:outline-none">
                    <span className="sr-only">View details for {recipe.name}</span>
                  </Link>
                </div>
                <p className="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{recipe.name}</p>
              </li>
            ))}
          </ul>
        </div>
      </div>

      <Dialog open={open} onClose={onClose}>
        <DialogTitle>
          Select Method
        </DialogTitle>
        <DialogBody>
          {confirmUrl ? (
            <form className="space-y-4">
              <Fieldset>
                <Field>
                  <Label>
                    Recipe URL
                  </Label>
                  <Input
                    value={data.url}
                    onChange={(e) => {
                      setData('url', e.target.value)
                    }}
                  />
                </Field>
              </Fieldset>
              <Button color="indigo">
                Get Recipe
              </Button>
            </form>
          ) : (
            <>
              <Button outline href={route('recipes.create')}>
                Manual entry
              </Button>
              <Button outline onClick={() => setConfirmUrl(true)}>
                Import from URL
              </Button>
            </>
          )}
        </DialogBody>
      </Dialog>
    </Authenticated>
  )
}
