<?php

namespace App\Services;

use App\Models\UserModel;
use Core\Classes\Helper;

class AuthService {
    private UserModel $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function getOneById(int $id): array {
        return $this->model->getOneById($id);
    }

    public function findOneByEmail(string $email): array {
        return $this->model->findOneByEmail($email);
    }

    public function create($name, $email, $password) {
        $newUser = [
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
        ];

        return $this->model->create($newUser);
    }
}