<?php

namespace Enries\Framework\Http\Exceptions;

class HttpException extends \Exception
{
    private int $statusCode;

    public function __construct(string $message = "", int $statusCode = 500)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    static public function MethodNotAllowed(string $message): HttpException
    {
        return new HttpException($message, 405);
    }

    static public function NotFound(string $message): HttpException
    {
        return new HttpException($message, 404);
    }
}