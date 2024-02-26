<?php

namespace App\Services;

use App\Models\UserModel;

class AuthService {
    private UserModel $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function getOneById(int $id): int {
        return $this->model->getOneById($id);
    }

    public function getAll(): array {
        return $this->model->getAll();
    }
}