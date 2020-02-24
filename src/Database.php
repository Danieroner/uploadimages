<?php

namespace App;

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

    private static $instance;
    private static $pg;

    protected function construct__() {}

    protected function __clone() {}

    public function __wakeup() {
        throw new \Exception('Cannot unserialize.');
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$pg = pg_connect(
                'host='    . CONFIG['DB_HOST'] . ' ' .
                'port='    . 5432              . ' ' .
                'dbname='  . CONFIG['DB_NAME'] . ' ' .
                'user='    . CONFIG['DB_USER'] . ' ' .
                'password='. CONFIG['DB_PASS']
            )or die('Could not connect: ' . pg_last_error());
        }
        return self::$instance;
    }

    public function query(string $query) {
        return pg_query($query);
    }

    public function all($result) {
        return pg_fetch_all($result, PGSQL_ASSOC);
    }

    public function free($result) {
        return pg_free_result($result);
    }

    public function close() {
        return pg_close(self::$pg);
    }
}