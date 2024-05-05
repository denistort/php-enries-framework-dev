<?php declare(strict_types=1);

use Enries\Framework\Http\Kernel;
use League\Container\Container;
use Enries\Framework\Contracts\RouterInterface;
use Enries\Framework\Routing\Router;

$container = new Container();

$container->add(RouterInterface::class, Router::class);
$container->add(Kernel::class)->addArgument(RouterInterface::class);

return $container;