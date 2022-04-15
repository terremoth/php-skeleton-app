<?php

session_start();

const DS = DIRECTORY_SEPARATOR;
const EOL = PHP_EOL;

function echoln($var) {
    echo $var.'<br>'.EOL;
}

function dd(...$vars) {
    foreach ($vars as $var) {
        var_dump($var);
    }

    exit(2);
}

require '../vendor/autoload.php';

require_once '../config/errors.php';
require_once '../config/routes.php';