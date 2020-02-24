<?php 

declare(strict_types=1);

namespace App;

use App\Database;

class Storage {

    protected object $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    public function show(): array {
        $result = $this->database->prepare(
            $this->database::$pg,
            'query',
            'SELECT * FROM public.images'
        );
        $result = $this->database->exec(
            $this->database::$pg,
            'query',
            array()
        );
        $context = $this->database->all($result);
        $this->database->free($result);

        return $context;
    }

    public function save(array $credentials, string $filename): void {
        $title = $credentials['title'];
        $slug = str_replace(' ', '-', $title);
        $description = $credentials['description'];

        $result = $this->database->prepare(
            $this->database::$pg,
            'insert',
            "INSERT INTO 
            public.images (url, title, description, image) 
            VALUES ($1, $2, $3, $4)"
        );
        $result = $this->database->exec(
            $this->database::$pg,
            'insert',
            array($slug, $title, $description, $filename)
        );
        $this->database->free($result);
    }

    public function __destruct() {
        $this->database->close();
    }
}