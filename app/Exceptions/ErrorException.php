<?php

namespace App\Exceptions;

use Exception;

class ErrorException extends Exception
{
    protected $message;
    protected $body;

    public function __construct(string $message, array $body = [])
    {
        parent::__construct($message);
        $this->message = $message;
        $this->body = $body;
    }

    public function getMessageInfo(): string
    {
        return $this->message;
    }

    public function getMessageBody():array
    {
        return $this->body;
    }
}
