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

    public function create($title, $description, $img = "") {
        $newPost = [
            "title" => $title,
            "description" => $description,
            "img" => $img
        ];

        return $this->model->create($newPost);
    }

    public function update($id, $title, $description, $img = "") {
        $post = $this->model->getPostById($id);

        if ($post) {
            $newPost = [
                "id" => $id,
                "title" => $title,
                "description" => $description,
                "img" => $img
            ];

            return $this->model->update($newPost);
        }

        return false;
    }

    public function delete(int $postID): bool {
        $post = $this->model->getPostById($postID);

        $isDeleted = false;

        if ($post) {
            $isDeleted = (bool)$this->model->delete($postID);
        }

        return $isDeleted;
    }
}