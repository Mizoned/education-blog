<?php

namespace App\Models;

use Core\Classes\Model;

class PostModel extends Model {
    public function getPostById(int $id): int
    {
        return 1;
    }

    public function findAll(): array {
        return $this->database->query("SELECT * FROM posts;")->findAll();
    }

    public function getOne(int $id): array {
        return $this->database->query("SELECT * FROM posts WHERE id = $id LIMIT 1;")->find();
    }
}