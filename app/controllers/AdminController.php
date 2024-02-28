<?php

namespace App\Controllers;

use App\Services\PostService;
use Core\Classes\Controller;

class AdminController extends Controller {

    private PostService $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    public function index(): void {
        $posts = $this->postService->getAll();

        $this->view("admin.index", [
            "posts" => $posts
        ]);
    }
}