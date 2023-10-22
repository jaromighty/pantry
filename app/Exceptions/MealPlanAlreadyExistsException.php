<?php

namespace App\Exceptions;

use Exception;

class MealPlanAlreadyExistsException extends Exception
{
    public function report(): bool
    {
        return true;
    }
}
