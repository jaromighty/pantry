import {PageProps} from "@/types";
import {Head} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";

export default function ShoppingListShow ({ auth }: PageProps) {
  return <>
    <Head title="Shopping List"/>

    <Authenticated user={auth.user}></Authenticated>
  </>;
}
