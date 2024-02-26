<?php

namespace App\Services;

use App\Models\PostModel;

class PostService {
    private PostModel $model;

    public function __construct() {
        $this->model = new PostModel();
    }

    public function getOne(int $id): array {
        return $this->model->getOne($id);
    }

    public function getAll(): array {
        return $this->model->findAll();
    }
}