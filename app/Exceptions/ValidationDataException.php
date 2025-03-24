<?php

namespace App\Exceptions;

use Exception;

class ValidationDataException extends Exception
{

        public function __construct($message = 'Validation failed.', $code = 422, Exception $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
}
