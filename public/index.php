<?php

/**
 * Налаштування виводу помилок
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Функція для підключення файлу відображення
 *
 * @param array $data
 * @param string $file
 */
function view(array $data, $file = 'index')
{
    include_once __DIR__ . "/../application/views/{$file}.php";
}

include_once __DIR__ . '/../config/autoloader.php';

/**
 * Шлях до папки де лежать конфігураційні файли
 */
$file_path = str_replace('/', DIRECTORY_SEPARATOR, dirname(__DIR__ ));

define('DB_CONFIG', $file_path);

/**
 * Класу Controller потрібен клас LogRepository для запису даних в БД
 */
$logger = new \NovaPosta\Application\Repository\LogRepository();
/**
 * Клас який обробляє запити
 */
$testTask = new \NovaPosta\Application\Controllers\Controller($logger);
$testTask->index();







/**
 * Задача, яка була на співбесіді щодо пошуку найближчого числа в масиві
 */
// Знайти найближче число в заданому масиві
findClosest([-2, 7, 10, 30, 432, 11], 432);

/**
 * @param array $array
 * @param int $number
 * @return int|mixed
 */
function findClosest(array $array, $number) {
    $result = 0;

    if (max($array) < $number) { // якщо максимельне число в масиві менше за 2-й параметр
        $result = max($array);
    } else if (min($array) > $number) { // якщо мінімальне число в масиві більше за 2-й параметр
        $result = min($array);
    } else if (in_array($number, $array)) { // якщо число в масиві рівне 2-му параметру
        $result = $number;
    } else { // пошук найближчого до 2-го параметру числа в масиві
        $value  = (2 * max($array));

        foreach($array as $num) {
            if ($value > abs($number - $num)) {
                $value = abs($number - $num);

                $result = $num;
            }
        }
    }

    return $result;
}