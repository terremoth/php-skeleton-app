<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $routes) {
    include_once '../routes/web.php';
    // require_once '../routes/api.php'; // example
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echoln('NOT FOUND');
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echoln('NOT ALLOWED');
        break;

    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars    = $routeInfo[2];
//        echoln('aqui');
//        dd($handler);

        if (is_callable($handler)) {
            call_user_func_array($handler, $vars);
        } else {
            $handlerParts = explode("@", $handler);
            $isClass = count($handlerParts) == 2;

            if ($isClass) {
                list($class, $method) = $handlerParts;
                call_user_func_array([new $class, $method], $vars);
            } else {
                $func = $handlerParts[0];
                call_user_func_array($func, $vars);
            }
        }

        break;
}
