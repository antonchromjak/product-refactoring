<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/../config/config.php';
require __DIR__ . '/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
$twig = new Twig_Environment($loader);

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__ . '/../var/logs/main.log', Logger::DEBUG));

Log::$instance  = $log;

try {
    $type = $_GET['type'] ?? 'product';
    $controllerName = "\App\Controller\\".ucfirst($type)."Controller";
    $controller = New $controllerName($twig);
    $controller->render();
} catch (\Throwable $e) {
    Log::critical($e->getMessage());
    echo $twig->render('error.html');
}

