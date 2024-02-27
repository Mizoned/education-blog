<?php

namespace App\Controllers;

use App\Services\PostService;
use Core\Classes\Controller;
use Core\Classes\Router;
use Core\Classes\Validator;

class PostController extends Controller {
    private PostService $service;

    public function __construct() {
        $this->service = new PostService();
    }

    public function index(): void {
        $posts = $this->service->getAll();

        $this->view("posts.index", [
            "posts" => $posts
        ]);
    }

    public function detail(): void {
        $post = $this->service->getOne(intval($_GET["id"]));

        $this->view("posts.detail", [
            "post" => $post
        ]);
    }

    public function create(): void {
        $this->view("posts.create", []);
    }

    public function store(): void {
        $newPost = [
           "title" => $_POST["title"],
           "description" => $_POST["description"],
            "img" => $_POST["img"] ?? ""
        ];

        $rules = [
            "title" => ["required", "min:3", "max:100"],
            "description" => ["required"]
        ];

        $messages = [
            "title" => [
                'required' => "Поле не должно быть пустым",
                "min" => "Поле должно быть больше :min символов",
                "max" => "Поле должно быть меньше :max символов"
            ],
            "description" => [
                'required' => "Поле не должно быть пустым"
            ],
        ];

        $validator = new Validator($newPost, $rules, $messages);
        $validator->validate();

        if (!$validator->hasErrors()) {
            $result = $this->service->create($newPost["title"], $newPost["description"], $newPost["img"]);

            if ($result) {
                $controllerData = ["success" => "Новый пост успешно создан!"];
            } else {
                $controllerData = [
                    "post" => $newPost,
                    "error" => 'Произошла непредвиденная ошибка!'
                ];
            }
        } else {
            $controllerData = [
                "post" => $newPost,
                "validation" => $validator->getErrors()
            ];
        }

        $this->view("posts.create", $controllerData);
    }
}