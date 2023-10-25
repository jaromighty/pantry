export interface Ingredient {
  id: number;
  name: string;
}

export interface Recipe {
  id: number;
  name: string;
  ingredients: Ingredient[];
}

export interface ShoppingList {
  id: number;
  ingredients: Ingredient[];
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
