<?php

namespace App\Controllers;

use App\Services\PostService;
use Core\Classes\Controller;
use Core\Classes\View;

class PostController extends Controller {
    private PostService $service;

    public function __construct() {
        $this->service = new PostService();
    }

    public function index(): void {
        $posts = $this->service->getAll();

        $this->view('posts.index', [
            "posts" => $posts
        ]);
    }

    public function detail(): void {
        $post = $this->service->getOne(intval($_GET["id"]));

        $this->view('posts.detail', [
            "post" => $post
        ]);
    }
}