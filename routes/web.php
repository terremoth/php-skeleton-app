<?php

/** @var $routes FastRoute\RouteCollector */

$routes->addRoute('GET', '/', function() {
    echo <<<HTML
        <h1>Home sweet Home!</h1>
    HTML;
});

$routes->addRoute('GET', '/example', \Models\Example::class.'@show');


function outsideFunc() {
    echoln("I am a function from outside!");
}

$routes->addRoute('GET', '/static', 'outsideFunc');