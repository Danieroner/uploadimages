<?php

namespace Src\Handle;

interface iFiles {
    public static function allowed(array $file);
}

class HandleFiles implements Ifiles {

    protected array $file;
    protected string $upload_dir = __DIR__ . '\uploads';

    protected static array $extensions = [
        'image/jpg',
        'image/jpeg',
        'image/png'
    ];

    protected int $max_size = 2048;

    public function __construct(array $file) {
        $this->file = $file;
    }

    public static function allowed(array $file): bool {

        foreach ($file as $key => $value) {
            for ($i = 0; $i < count(self::$extensions); $i++) { 
                if ($value['type'] == self::$extensions[$i]) {
                    return true;
                }
            }
        }
        return false;
    }

    public function run() {
        if(is_uploaded_file($this->file)) {

        }
    }
}