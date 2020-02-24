<?php

namespace Src\Handle;

interface iFiles {
    public function allowed(array $file): bool;
    public function run(): int;
}

class HandleFiles implements Ifiles {

    protected array $file;
    protected string $upload_dir = __DIR__ . '\uploads';

    protected array $extensions = [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif'
    ];

    protected int $max_size = 5242880; // 5mb

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

    public function run(): int {
        if(!is_uploaded_file($this->file['tmp_name'])) {
            return 500;
        }

        $tmp_name = $this->file['tmp_name'];
        
        $img_name = basename(substr(
            md5(sha1(uniqid($this->file['name']))), 0, 8
        ));
        $ext = explode('.', $this->file['name']);
        $img_ext = end($ext);

        if (!file_exists($this->upload_dir)) {
            if (!mkdir($this->upload_dir, 0777, true)) 
                die('Failed to create folders...');
        }

        if(!$this->allowed($this->file)) {
            return 401;
        }

        if($this->file['size'] > $this->max_size) {
            return 431;
        }

        if (move_uploaded_file($tmp_name, 
        $this->upload_dir . DIRECTORY_SEPARATOR . $img_name . '.' . $img_ext)) {
            return 201;
        }
    }
}