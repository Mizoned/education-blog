<?php

namespace App\Services;

use App\Models\UserModel;

class UserService {
    private UserModel $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function findAll() {
        $users = $this->model->findAll();

        $userResult = [];

        foreach ($users as $user) {
            $userResult[] = [
                "id" => $user["id"],
                "name" => $user["name"],
                "email" => $user["email"]
            ];
        }

        return $userResult;
    }

    public function delete(int $userID): bool {
        $post = $this->model->getOneById($userID);

        $isDeleted = false;

        if ($post) {
            $isDeleted = (bool)$this->model->delete($userID);
        }

        return $isDeleted;
    }
}