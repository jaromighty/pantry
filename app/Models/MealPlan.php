<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
    ];

    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
    }

    public function meals(): HasManyThrough
    {
        return $this->hasManyThrough(Meal::class, Day::class);
    }

    public function shoppingList(): HasOne
    {
        return $this->hasOne(ShoppingList::class);
    }
}
