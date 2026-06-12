<?php

namespace IBSWebCO\CommercioEstero\BrowserClient\Exceptions;

class LoginException extends \Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    #[\Override]
    public function __toString(): string
    {
        return __CLASS__.": [{$this->code}]: {$this->message}\n";
    }
}
