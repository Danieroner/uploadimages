<?php

namespace Src\Handle;

interface iFiles {
    public function allowed(array $file);
}

class HandleFiles implements Ifiles {

    protected array $file;
    protected string $upload_dir = __DIR__ . '\uploads';

    protected array $extensions = [
        'image/jpg',
        'image/jpeg',
        'image/png'
    ];

    protected int $max_size = 2048;

    public function __construct(array $file) {
        foreach ($file as $element) {
            $this->file = $file['image'];
        }
    }

    public function allowed(array $file): bool {

        for ($i = 0; $i < count($this->extensions); $i++) { 
            if ($file['type'] == $this->extensions[$i]) {
                return true;
            }
        }

        return false;
    }

    public function run(): string {
        if(!is_uploaded_file($this->file['tmp_name'])) {
            return 'false';
        }

        $tmp_name = $this->file['tmp_name'];
        $img_name = basename($this->file['name']);

        if (!file_exists($this->upload_dir)) {
            if (!mkdir($this->upload_dir, 0777, true)) 
                die('Failed to create folders...');
        }

        if(!$this->allowed($this->file)) {
            return 'no se puede';
        }

        if($this->file['size'] > $this->max_size) {
            return 'archivo muy grande';
        }

        if (move_uploaded_file($tmp_name, 
        $this->upload_dir . DIRECTORY_SEPARATOR . $img_name)) {
            print_r($this->file);
        }
    }
}