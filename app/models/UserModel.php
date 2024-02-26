<?php

namespace App\Models;

class UserModel {
    private $mysqli;

    public function __construct() {
        global $mysqli;
        $this->mysqli = $mysqli;
    }

    public function getAll(): array {
        return ['User 1', 'User 2', 'User 3'];
    }

    public function getOneById(int $id) {
        return 1;
    }
}