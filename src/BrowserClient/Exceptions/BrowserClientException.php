<?php

namespace IBSWebCO\CommercioEstero\BrowserClient\Exceptions;

use Exception;
use Override;
use Throwable;

class BrowserClientException extends Exception
{
    public function __construct(
        string $message = "",
        int $code = 0,
        Throwable|null $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    #[Override]
    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
