import {MealType, RecipeType} from "@/enums";

export interface Ingredient {
  id: number;
  name: string;
}

export interface Recipe {
  id: number;
  name: string;
  type: RecipeType;
  ingredients: Ingredient[];
  pivot: {
    meal_id: number;
    recipe_id: number;
  }
}

export interface Meal {
  id: number;
  day_id: number;
  type: MealType;
  recipes: Recipe[];
}

export interface MealPlan {
  id: number;
  start_date: string;
  end_date: string;
  shopping_list: ShoppingList;
  days: Day[];
}

export interface ShoppingList {
  id: number;
  ingredients: Ingredient[];
}

export interface Day {
  id: number;
  date: string;
  meals: Meal[];
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
