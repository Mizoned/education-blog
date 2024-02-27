<?php

namespace Core\Classes;

abstract class Model {
    protected Database $database;
    public function __construct() {
        $this->database = App::get(DataBase::class);
    }
}