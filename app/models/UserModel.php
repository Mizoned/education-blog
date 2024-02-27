<?php

namespace App\Models;

use Core\Classes\Model;

class UserModel extends Model {

    public function getOneById(int $id): array {
        return $this->database->query("SELECT * FROM users WHERE id = '$id' LIMIT 1;")->find();
    }

    public function findOneByEmail(string $email): array {
        return $this->database->query("SELECT * FROM users WHERE email = '$email' LIMIT 1;")->find();
    }
}