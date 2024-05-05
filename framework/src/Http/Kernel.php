<?php
declare(strict_types=1);

namespace Enries\Framework\Http;

use Enries\Framework\Contracts\RouterInterface;
use Enries\Framework\Http\Exceptions\HttpException;

readonly class Kernel
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $params] = $this->router->dispatch($request);
            return call_user_func_array($routeHandler, $params);
        } catch (HttpException $e) {
            return (new Response())
                ->setContent($e->getMessage())
                ->setStatusCode($e->getStatusCode());
        } catch (\Throwable $e) {
            return (new Response())
                ->setContent($e->getMessage())
                ->setStatusCode(500);
        }
    }
}