<?php

use Enries\Framework\Http\{Request, Kernel};

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

/** @var League\Container\Container $container */
$container = require BASE_PATH.'/config/services.php';
$request = Request::createFromGlobals();

/** @var Enries\Framework\Http\Kernel $kernel */
$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);
$response->send();