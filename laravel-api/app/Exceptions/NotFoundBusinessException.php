<?php

namespace App\Exceptions;

class NotFoundBusinessException extends BusinessException
{
    public function __construct(string $message = 'Resource not found')
    {
        parent::__construct($message, 404);
    }
}

