import {PageProps} from "@/types";
import {Head} from "@inertiajs/react";
import Authenticated from "@/Layouts/AuthenticatedLayout";

export default function SettingsEdit({ auth }: PageProps) {
  return <>
    <Head title="Settings" />

    <Authenticated user={auth.user}>
      <div className="py-4 max-w-7xl mx-auto px-4 sm:px-6 sm:py-8 lg:px-0"></div>
    </Authenticated>
  </>
;
}
