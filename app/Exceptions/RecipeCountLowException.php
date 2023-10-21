<?php

namespace App\Exceptions;

use Exception;

class RecipeCountLowException extends Exception
{
    public function report(): bool
    {
        return true;
    }
}
