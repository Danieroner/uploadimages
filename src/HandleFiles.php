<?php
declare(strict_types=1);

namespace App;

interface iFiles {
    public function allowed(array $file): bool;
    public function run(): int;
}

class HandleFiles implements Ifiles {

    public array $file;

    public bool $status;

    protected string $upload_dir = __DIR__ . DIRECTORY_SEPARATOR .'uploads' . DIRECTORY_SEPARATOR;

    protected array $extensions = [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif'
    ];
    
    protected int $max_size = 5242880; // 5mb

    public function __construct(array $file = null) {
        $this->status = true;
        if ($file != null) {
            foreach ($file as $element) {
                $this->file = $file['image'];
            }
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
            $this->status = false;
            return 500;
        }

        if(!$this->allowed($this->file)) {
            $this->status = false;
            return 401;
        }

        if($this->file['size'] > $this->max_size) {
            $this->status = false;
            return 431;
        }

        if (!file_exists($this->upload_dir)) {
            if (!mkdir($this->upload_dir, 0777, true)) 
                die('Failed to create folders...');
        }

        $tmp_name = $this->file['tmp_name'];
        $img_name = basename(substr(
            md5(sha1(uniqid($this->file['name']))), 0, 8
        ));
        
        $ext = explode('.', $this->file['name']);
        $img_ext = end($ext);

        // Name to database
        $this->file['name'] = $img_name . '.' . $img_ext;

        $final_image = $this->upload_dir . DIRECTORY_SEPARATOR . $img_name . '.' . $img_ext;     

        if (!move_uploaded_file($tmp_name, $final_image)) {
            die('Failed to move file...');
        }
        
        return 201;
    }

    public function delete(string $file): void {
        if (!file_exists($this->upload_dir . $file)) {
            die('The file doesnt exist...');
        }
        
        if (!unlink($this->upload_dir . $file)) {
            die('Failed to delete file...');
        }
    }

}