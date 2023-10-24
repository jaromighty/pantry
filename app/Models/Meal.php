<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_id',
        'type',
    ];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class);
    }
}
