<?php

require '../vendor/autoload.php';

use Src\Conection\Database;

$router = new \Bramus\Router\Router();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');
$twig = new \Twig\Environment($loader);

$router->get('/', function () use ($twig) {

    $dbconn = Database::getInstance();
    $result = $dbconn->query('SELECT * FROM public.images');
    $context = $dbconn->all($result);
    $dbconn->free($result);
    $dbconn->close();
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

$router->run();