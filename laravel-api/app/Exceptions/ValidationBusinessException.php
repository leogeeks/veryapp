<?php

namespace App\Exceptions;

class ValidationBusinessException extends BusinessException
{
    /** @var array<string, mixed> */
    protected array $errors;

    public function __construct(string $message = 'Validation failed', array $errors = [], int $code = 422)
    {
        parent::__construct($message, $code);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

