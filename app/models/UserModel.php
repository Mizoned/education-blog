<?php

namespace App\Models;

use Core\Classes\Helper;
use Core\Classes\Model;

class UserModel extends Model {

    public function getOneById(int $id): array {
        return $this->database->query("SELECT * FROM users WHERE id = '$id' LIMIT 1;")->find();
    }

    public function findOneByEmail(string $email): array {
        return $this->database->query("SELECT * FROM users WHERE email = '$email' LIMIT 1;")->find();
    }

    public function create(array $post) {
        $name = $post['name'];
        $email = $post['email'];
        $password = $post["password"];

        return $this->database->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password');");
    }

    public function findAll(): array {
        return $this->database->query("SELECT * FROM users;")->findAll();
    }

    public function delete(int $userID) {
        return $this->database->query("DELETE FROM users WHERE id = '$userID';");
    }
}