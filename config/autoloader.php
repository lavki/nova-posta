<?php

//$underscores = function ($classname) {
//    $path = str_replace('\\\\', DIRECTORY_SEPARATOR, $classname);
//    $path = __DIR__ . "/$path";
//    if (file_exists("{$path}.php")) {
//        requare_once("{$path}.php");
//    }
//};
//\spl_autoload_register($underscores);

$namespaces = function ($path) {
    $file_path = str_replace('NovaPosta', '', dirname(__DIR__) . "{$path}.php");

    if (preg_match('/\\\\/',  $file_path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $file_path);
    }

    if (file_exists($path)) {
        require_once $path;
    }
};

spl_autoload_register($namespaces);
