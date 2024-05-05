<?php

declare(strict_types=1);

namespace Enries\Framework\Http;

class Request
{
    public function __construct(
        private readonly array $getParams,
        private readonly array $postData,
        private readonly array $cookies,
        private readonly array $files,
        private readonly array $server,
    ) {
    }

    public static function createFromGlobals(): static
    {
        return new static(
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES,
            $_SERVER,
        );
    }

    public function getCookieByName(string $key): array
    {
        return $this->cookies[$key];
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function getParam(string $key): mixed
    {
        return $this->getParams[$key];
    }

    public function getGetParams(): array
    {
        return $this->getParams;
    }

    public function getFile(string $filename): array
    {
        return $this->files[$filename];
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getPostData(): array
    {
        return $this->postData;
    }

    public function getServer(): array
    {
        return $this->server;
    }

    public function getRequestMethod(): string
    {
        return $this->getServer()['REQUEST_METHOD'];
    }

    public function getRequestUri(): string
    {
        return $this->getServer()['REQUEST_URI'];
    }

    public function getContentType(): string
    {
        return $this->getServer()['CONTENT_TYPE'];
    }
    public function getPathname(): string|false
    {
        return strtok($this->getRequestUri(), '?');
    }
}
