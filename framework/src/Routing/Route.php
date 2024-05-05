<?php
declare(strict_types=1);

namespace Enries\Framework\Routing;

class Route
{
    static function GET(string $uri, array|callable $handler): array
    {
        return ['GET', $uri, $handler];
    }

    static function POST(string $uri, array|callable $handler): array
    {
        return ['POST', $uri, $handler];
    }

    static function PUT(string $uri, array|callable $handler): array
    {
        return ['PUT', $uri, $handler];
    }
    static function PATCH(string $uri, array|callable $handler): array
    {
        return ['PATCH', $uri, $handler];
    }
    static function DELETE(string $uri, array|callable $handler): array
    {
        return ['DELETE', $uri, $handler];
    }
}