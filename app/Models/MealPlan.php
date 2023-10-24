<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
}
