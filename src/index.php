<?php

require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\views');
$twig = new \Twig\Environment($loader);
$router = new \Bramus\Router\Router();

$storage = new App\Storage();
$runtime = new App\Runtime();

$router->get('/', function () use ($runtime, $twig, $storage) {

    $context = $storage->all(new App\PostgresQueryBuilder());
    
    echo $twig->render('index.twig', [
        'context' => $context,
        'runtime' => $runtime->run()
    ]);

});

$router->get('/add', function () use ($runtime, $twig) {

    echo $twig->render('add.twig', [
        'runtime' => $runtime->run()
    ]);

});

$router->mount('/api', function () use ($router, $runtime, $twig, $storage) {

    $router->get('/{slug}', function ($slug) use ($runtime, $twig, $storage) {

        $context = $storage->show(new App\PostgresQueryBuilder(), $slug);
        
        echo $twig->render('show.twig', [
            'context' => $context,
            'runtime' => $runtime->run()
        ]);
    
    });

    $router->post('/add', function () use ($storage) {
        $handle = new App\HandleFiles($_FILES);
    
        echo $handle->run();
    
        if (!$handle->status) return;
    
        $storage->save(
            $_POST,
            $handle->file['name'],
            new App\PostgresQueryBuilder()
        );
    
    });

    $router->delete('/{id}', function ($id) {
        echo $id;
    });

});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    var_dump('404 t');
});

$router->run();