import {classNames} from "@/Utils/classNames";
import {MealType} from "@/enums";
import {Meal} from "@/types";

export default function MealCard({ meal, onClick }: { meal: Meal, onClick: () => void }) {
  const openMeal = (mealId: number) => {

  }

  return (
    <li>
      <button onClick={onClick} className={classNames(
        'group w-full flex flex-col text-left overflow-y-auto rounded-md p-2 text-xs leading-5',
        meal.type === MealType.BREAKFAST ? 'bg-orange-50 hover:bg-orange-100' : '',
        meal.type === MealType.LUNCH ? 'bg-blue-50 hover:bg-blue-100' : '',
        meal.type === MealType.DINNER ? 'bg-pink-50 hover:bg-pink-100' : '',
        meal.type === MealType.DESSERT ? 'bg-red-50 hover:bg-red-100' : ''
      )}>
        <p className={classNames(
          'order-1 font-semibold text-blue-700',
          meal.type === MealType.BREAKFAST ? 'text-orange-700' : '',
          meal.type === MealType.LUNCH ? 'text-blue-700' : '',
          meal.type === MealType.DINNER ? 'text-pink-700' : '',
          meal.type === MealType.DESSERT ? 'text-red-700' : ''
        )}>
          {meal.recipes[0].name}
        </p>
        <p className={classNames(
          meal.type === MealType.BREAKFAST ? 'text-orange-500 group-hover:text-orange-700' : '',
          meal.type === MealType.LUNCH ? 'text-blue-500 group-hover:text-blue-700' : '',
          meal.type === MealType.DINNER ? 'text-pink-500 group-hover:text-pink-700' : '',
          meal.type === MealType.DESSERT ? 'text-red-500 group-hover:text-red-700' : ''
        )}>
          {meal.type.charAt(0).toUpperCase() + meal.type.slice(1)}
        </p>
      </button>
    </li>
  );
}
