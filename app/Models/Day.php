<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'meal_plan_id',
    ];

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class);
    }
}
