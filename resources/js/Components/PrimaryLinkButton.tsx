import {InertiaLinkProps, Link} from "@inertiajs/react";

export default function PrimaryLinkButton ({ children, href }: InertiaLinkProps) {
  return (
    <Link
      href={href}
      className="relative inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >
      {children}
    </Link>
  );
}
