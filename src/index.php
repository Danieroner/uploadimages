<?php

require '../vendor/autoload.php';

$router = new \Bramus\Router\Router();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');
$twig = new \Twig\Environment($loader);

$router->get('/', function () use ($twig) {
    echo $twig->render('index.twig', ['name' => 'app']);
});

$router->get('/add', function () use ($twig) {
    echo $twig->render('add.twig');
});

$router->run();