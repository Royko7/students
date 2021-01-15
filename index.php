<?php

require 'lib/dev.php';

use  core\Router;
use Models\Students;

spl_autoload_register(function ($class) {

    $path = str_replace('\\', '/', $class . '.php');
//    echo $path;
    if (file_exists($path)) {
        require $path;
    }
});

$router = new Router;
//$m = new Students;
//$m->getUsers();
$router->run();
