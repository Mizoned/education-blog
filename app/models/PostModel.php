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

    public function create(array $post) {
        $title = $post['title'];
        $description = $post['description'];
        $img = $post["img"];

        return $this->database->query("INSERT INTO posts (title, description, img) VALUES ('$title', '$description', '$img');");
    }

    public function delete(int $postID) {
        return $this->database->query("DELETE FROM posts WHERE id = '$postID'");
    }

    public function update(array $post) {
        $id = $post['id'];
        $title = $post['title'];
        $description = $post['description'];
        $img = $post["img"];

        return $this->database->query("UPDATE posts SET title = '$title', description = '$description', img = '$img' WHERE id = '$id';");
    }
}