<?php

require '../vendor/autoload.php';

use Src\Conection\Database;
use Src\Handle\HandleFiles;

$router = new \Bramus\Router\Router();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');
$twig = new \Twig\Environment($loader);

$router->get('/', function () use ($twig) {
    $database = Database::getInstance();
    $result = $database->query('SELECT * FROM public.images');
    $context = $database->all($result);
    $database->free($result);
    $database->close();

    $time = (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']);

    echo $twig->render('index.twig', [
        'name' => $context,
        'time' => round($time, 4)
    ]);
});

$router->get('/add', function () use ($twig) {
    $time = (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']);
    echo $twig->render('add.twig', [
        'time' => round($time, 4)
    ]);
});

$router->post('/add', function () {
    $handler = new HandleFiles($_FILES);
    echo $handler->run();
});

$router->run();