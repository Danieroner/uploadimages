<?php

require '../vendor/autoload.php';

use Src\Conection\Database;
use Src\Handle\HandleFiles;

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

$router->post('/add', function () {
    if(is_uploaded_file($_FILES['image']['tmp_name'])) {
        $upload_dir = __DIR__ . '\uploads';
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_name = basename($_FILES['image']['name']);

        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die('Failed to create folders...');
            }
        }
        if (HandleFiles::allowed($_FILES)) {
            echo 'true';
        } else {
            echo 'false';
        }
        // move_uploaded_file($tmp_name, 
        //     $upload_dir . DIRECTORY_SEPARATOR . $img_name
        // );

    }
});

$router->run();