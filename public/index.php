<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

function view(array $data, $file = 'index')
{
    include_once __DIR__ . "/../application/views/{$file}.php";
}

include_once __DIR__ . '/../config/autoloader.php';

$file_path = str_replace('/', DIRECTORY_SEPARATOR, dirname(__DIR__ ) . "/config/enviroment.json");
define('DB_CONFIG', $file_path);

$validator = new \NovaPosta\Application\Validator\DateValidator();
$logger    = new \NovaPosta\Application\Repository\LogRepository();
$testTask  = new \NovaPosta\Application\Controllers\Controller($validator, $logger);
$testTask->index();