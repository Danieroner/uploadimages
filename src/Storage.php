<?php 

namespace App;

use App\Database;

class Storage {

    protected object $database;

    public function __construct() {
        $this->database = Database::getInstance();
    }

    public function show(): array {
        $result = $this->database->query(
            'SELECT * FROM public.images'
        );
        $context = $this->database->all($result);
        $this->database->free($result);

        return $context;
    }

    public function save(array $credentials, string $filename): void {
        $title = $credentials['title'];
        $slug = str_replace(' ', '-', $title);
        $description = $credentials['description'];

        $result = $this->database->query(
            "INSERT INTO 
            public.images (id, url, title, description, image) 
            VALUES ((SELECT MAX(id)+1 FROM public.images), '$slug', '$title', '$description', '$filename')"
        );

        $this->database->free($result);
    }

    public function __destruct() {
        $this->database->close();
    }
}