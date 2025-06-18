<?php

namespace App\Enums;

enum Unit
{
    case CUP;
    case TSP;
    case UNIT;

    public function name(): string
    {
        return match ($this) {
            Unit::CUP => 'cup',
            Unit::TSP => 'tsp',
            Unit::UNIT => 'unit',
        };
    }
}
