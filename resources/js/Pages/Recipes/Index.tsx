import {PageProps} from "@/types";
import Authenticated from "@/Layouts/AuthenticatedLayout";

export default function RecipesIndex ({ auth }: PageProps) {
  return (
    <Authenticated user={auth.user}></Authenticated>
  );
}
