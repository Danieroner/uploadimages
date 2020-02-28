<?php

declare(strict_types=1);

namespace App;


class Database extends \PDO {

    public function __construct() {

        $content = file_get_contents('../credentials.json');
        $encode = utf8_encode($content);
        $result = json_decode($encode, true);

        $credentials = $result['db_driver'] . ':host=' . $result['db_host'] . ((!empty($result['db_port'])) ? (';port=' . $result['database']['port']) : '') . ';dbname=' . $result['db_name'];

        try {
            parent::__construct($credentials, $result['db_user'], $result['db_pass']);
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

    }

}