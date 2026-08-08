<?php

namespace App\Exceptions;

use RuntimeException;

class ApiException extends RuntimeException
{
    public function __construct(
        public readonly string $ref,
        string $message,
        public readonly int $status = 400,
        public readonly mixed $data = null,
    ) {
        parent::__construct($message);
    }
}
