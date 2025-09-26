<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    public function __construct(string $message = 'Business rule violation', int $code = 422)
    {
        parent::__construct($message, $code);
    }
}

