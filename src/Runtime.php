<?php

declare(strict_types=1);

namespace App;

class Runtime {

    protected float $time;

    public function __construct() {
        $this->time = (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']);
    }

    public function run(): float {

        $round = round($this->time, 3);

        return $round;
    }
}