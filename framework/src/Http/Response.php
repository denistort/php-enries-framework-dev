<?php

declare(strict_types=1);

namespace Enries\Framework\Http;

class Response
{
    private mixed $content;
    private int   $statusCode = 200;
    private array $headers = [];

    public function setContent(mixed $content): static
    {
        $this->content = $content;
        return $this;
    }
    public function setStatusCode(int $statusCode = 200): static
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    public function setHeaders(array $headers): static
    {
        $this->headers = $headers;
        return $this;
    }
    public function send(): void
    {
        http_response_code($this->statusCode);
        echo $this->content;
    }
}
