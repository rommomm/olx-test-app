<?php

namespace App\Exceptions;

use Exception;

class ParsingException extends Exception
{
    public function __construct(string $url, $message = 'Failed to parse data from the specified URL.')
    {
        $message .= " URL: $url";
        parent::__construct($message);
    }
}
