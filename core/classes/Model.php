<?php

namespace Core\Classes;

abstract class Model {
    protected $database;
    public function __construct() {
        global $database;

        $this->database = $database;
    }
}