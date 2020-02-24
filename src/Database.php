<?php

declare(strict_types=1);

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
    public static $pg;

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

    public function prepare($conn, string $name, string $query) {
        return pg_prepare($conn, $name, $query);
    }

    public function exec($conn, string $name, array $params) {
        return pg_execute($conn, $name, $params);
    }

    public function all($result) {
        return pg_fetch_all($result, PGSQL_ASSOC);
    }

    public function free($result): bool {
        return pg_free_result($result);
    }

    public function close(): bool {
        return pg_close(self::$pg);
    }
}