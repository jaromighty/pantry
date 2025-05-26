<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'active_program_id',
    ];

    public function activeProgram(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'active_program_id');
    }

    public static function getActiveProgram(): ?Program
    {
        return static::first()?->activeProgram;
    }
}
