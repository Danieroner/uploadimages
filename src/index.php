<?php

require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');
$twig = new \Twig\Environment($loader);
$router = new \Bramus\Router\Router();
$storage = new App\Storage();
$runtime = new App\Runtime();

$router->get('/', function () use ($twig, $storage, $runtime) {
    echo $twig->render('index.twig', [
        'context' => $storage->show(),
        'runtime' => $runtime->run()
    ]);
});

$router->get('/add', function () use ($twig, $runtime) {
    echo $twig->render('add.twig', [
        'runtime' => $runtime->run()
    ]);
});

$router->post('/add', function () use ($storage) {
    $handle = new App\HandleFiles($_FILES);

    echo $handle->run();

    if (!$handle->status) return;

    $storage->save($_POST, $handle->file['name']);

});

$router->run();