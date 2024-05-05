<?php
declare(strict_types=1);

namespace Enries\Framework\Routing;

use Enries\Framework\Contracts\RouterInterface;
use Enries\Framework\Http\Exceptions\HttpException;
use Enries\Framework\Http\Request;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{

    /**
     * @param Request $request
     * @return array
     * @throws HttpException
     */
    public function dispatch(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $routes = include BASE_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }
        });

        $routeInfo = $dispatcher->dispatch($request->getRequestMethod(), $request->getPathname());
        $status = $routeInfo[0];

        switch ($status) {
            case Dispatcher::FOUND:
                [$status, $handler, $params] = $routeInfo;
                if (is_array($handler)) {
                    [$controller, $method] = $handler;
                    $handler = [new $controller, $method];
                }
                return [$handler, $params];
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = implode(', ', $routeInfo[1]);
                $message = "Supported http methods {$allowedMethods}";
                throw HttpException::MethodNotAllowed($message);
            default:
                $message = "Nothing found {$request->getRequestUri()}";
                throw HttpException::NotFound($message);
        }
    }
}