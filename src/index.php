<?php

require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/cache'
]);
$router = new \Bramus\Router\Router();

$storage = new App\Storage();
$runtime = new App\Runtime();

$router->get('/', function () use ($runtime, $twig, $storage) {
    $context = $storage->all(new App\PostgresQueryBuilder());
    
    $twig->display('index.twig', [
        'context' => $context,
        'runtime' => $runtime->run()
    ]);
});

$router->get('/add', function () use ($runtime, $twig) {
    $twig->display('add.twig', [
        'runtime' => $runtime->run()
    ]);
});

$router->get('/edit/{id}', function ($id) use ($runtime, $storage, $twig) {
    $context = $storage->getOne(new App\PostgresQueryBuilder(), $id);
    $twig->display('edit.twig', [
        'context' => $context,
        'runtime' => $runtime->run()
    ]);
});

$router->mount('/api', function () use ($router, $runtime, $twig, $storage) {

    $router->get('/{slug}', function (string $slug) use ($runtime, $twig, $storage) {
        $context = $storage->show(new App\PostgresQueryBuilder(), $slug);

        if (!$context) {
            header('HTTP/1.1 404 Not Found');
            $twig->display('404.twig', [
                'runtime' => $runtime->run()
            ]);
        } else {
            $twig->display('show.twig', [
                'context' => $context,
                'runtime' => $runtime->run()
            ]);
        }
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

    $router->delete('/{id}', function (string $id) use ($storage) {
        $handle = new App\HandleFiles();
        
        $file = $storage->getId(new App\PostgresQueryBuilder(), $id);

        $handle->delete($file);

        $storage->delete(new App\PostgresQueryBuilder(), $id);
    });

    $router->put('/edit/{$id}', function ($id) use ($storage) {
        $putfp = fopen('php://input', 'r');
        $putdata = '';

        while($data = fread($putfp, 1024)) {
            $putdata .= $data;
        }
            
        fclose($putfp);

        $decode = json_decode($putdata, $assoc = true);
        $storage->update(new App\PostgresQueryBuilder(), $decode, $id); 
    });

});

$router->set404(function() use ($runtime, $twig){
    header('HTTP/1.1 404 Not Found');
    $twig->display('404.twig', [
        'runtime' => $runtime->run()
    ]);
});

$router->run();