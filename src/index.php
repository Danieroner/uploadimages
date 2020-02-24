<?php

require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');
$twig = new \Twig\Environment($loader);

$router = new \Bramus\Router\Router();

$storage = new App\Storage();

$time = (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']);

$router->get('/', function () use ($twig, $storage, $time) {
    echo $twig->render('index.twig', [
        'context' => $storage->show(),
        'time' => round($time, 4)
    ]);
});

$router->get('/add', function () use ($twig, $time) {
    echo $twig->render('add.twig', [
        'time' => round($time, 4)
    ]);
});

$router->post('/add', function () use ($storage) {
    $handle = new App\HandleFiles($_FILES);

    echo $handle->run();

    if (!$handle->status) return;

    $storage->save($_POST, $handle->file['name']);

});

$router->run();