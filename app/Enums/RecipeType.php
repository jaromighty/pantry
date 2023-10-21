<?php

namespace App\Enums;

enum RecipeType: string
{
    case BREAKFAST = 'breakfast';
    case LUNCH = 'lunch';
    case SNACK = 'snack';
    case DINNER = 'dinner';
    case DESSERT = 'dessert';
    case SIDE = 'side';
}
