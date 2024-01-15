import {PageProps} from "@/types";
import {ReactElement} from "react";
import Authenticated from "@/Layouts/AuthenticatedLayout";
import {Head} from "@inertiajs/react";

export default function RecipesImport ({ auth, url }: PageProps<{ url: string }>): ReactElement {
  return (
    <Authenticated user={auth.user}>
      <Head title="Import Recipe"/>

      <div className="py-4 max-w-7xl mx-auto px-4 sm:px-6 sm:py-8 lg:px-0">
        {url}
      </div>
    </Authenticated>
  )
}
