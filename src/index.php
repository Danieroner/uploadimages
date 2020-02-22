<?php

require '../vendor/autoload.php';

use Src\Conection\Database;

$router = new \Bramus\Router\Router();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');
$twig = new \Twig\Environment($loader);

$router->get('/', function () use ($twig) {
    $db = Database::getInstance();
    $data = ($db) ? 'true' : false;
    echo $twig->render('index.twig', ['name' => $data]);
});

$router->get('/add', function () use ($twig) {
    echo $twig->render('add.twig');
});

$router->run();