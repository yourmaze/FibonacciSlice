<?php

declare(strict_types=1);

spl_autoload_register("autoloader");

use Route\Request;

$request = new Request(
    $_SERVER,
    $_REQUEST
);

/**
 * @var ControllerInterface $handler
 */

if ($request->isGet()) {
    $handler = match ($request->uri()) {
        '/fibonacci' => 'views/fibonacci.php',
        default => 'views/404.php'
    };

    require $handler;
    exit();
}

$redis = new Redis();
$redis->connect('caching', 6379);
$redis->auth('redispass');

if ($request->isPost()) {
    $handler = match ($request->uri()) {
        '/fibonacci' => new GetFibonacciSliceController($redis),
        'default' => exit()
    };

    echo (new JsonResponse($handler))
        ->handle($request);

    exit();
}

require 'views/404.php';

function autoloader() {
    require_once '../app/Route/Request.php';
    require_once '../app/Controllers/GetFibonacciSliceController.php';
    require_once '../app/Controllers/ControllerInterface.php';
    require_once '../app/Controllers/JsonResponse.php';
    require_once '../app/Controllers/ResponseInterface.php';
    require_once '../app/Validators/GetFibonacciSliceValidator.php';
    require_once '../app/Validators/Commands/GetFibonacciSliceCommand.php';
    require_once '../app/Services/GetFibonacciNumberInterface.php';
    require_once '../app/Services/CalcFibonacciBineFormulaService.php';
    require_once '../app/Services/GetCacheableNumberService.php';
}