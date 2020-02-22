<?php

namespace Src\Conection;

$content = file_get_contents('../credentials.json');
$encode = utf8_encode($content);
$result = json_decode($encode, true);

define('CONFIG', [
    'DB_HOST' => $result['DB_HOST'],
    'DB_USER' => $result['DB_USER'],
    'DB_PASS' => $result['DB_PASS'],
    'DB_NAME' => $result['DB_NAME']
]);

class Database  {
    private static array $instances = [];

    protected function construct__() {
        pg_connect(
            'host='    . CONFIG['DB_HOST'] .
            'port='    . 5432 .
            'dbname='  . CONFIG['DB_NAME'] . 
            'user='    . CONFIG['DB_USER'] .
            'password='. CONFIG['DB_PASS']
        );
    }

    protected function __clone() {}

    public function __wakeup() {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    public static function getInstance(): Database {
        $cls = static::class;
        if(!isset(static::$instances[$cls])) {
            static::$instances[$cls] = new static;
        }

        return static::$instances[$cls];
    }
}