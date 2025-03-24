<?php

namespace App\Exceptions;

use Exception;

class UniqueDataException extends Exception
{


    public function __construct($message = 'User with this email or phone already exists.', $code = 409, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
