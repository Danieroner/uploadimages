<?php

require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');

$twig = new \Twig\Environment($loader);

echo $twig->render('index.twig', ['name' => 'app']);