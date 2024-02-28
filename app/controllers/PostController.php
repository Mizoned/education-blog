<?php

namespace App\Controllers;

use App\Components\AlertMessage;
use App\Services\PostService;
use Core\Classes\Controller;
use Core\Classes\Helper;
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

    public function createIndex(): void {
        $this->view("posts.create", []);
    }

    public function store(): void {
        $controllerData = [];

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

            if ($result !== false) {
                AlertMessage::setMessage("Новый пост успешно создан!", "success");
            } else {
                AlertMessage::setMessage("Произошла непредвиденная ошибка!", "error");
                $controllerData = [
                    "post" => $newPost
                ];
            }
        } else {
            $controllerData = [
                "post" => $newPost,
                "validation" => $validator->getErrors()
            ];
        }

        if (empty($controllerData)) {
            Router::redirect("/admin");
        } else {
            $this->view("posts.create", $controllerData);
        }
    }

    public function destroy(): void {
        $postID = $_POST["id"];

        $isDeleted = $this->service->delete($postID);

        if ($isDeleted) {
            $_SESSION["_message"] = [
                "message" => "Пост успешно удален!",
                "type" => "success"
            ];
        } else {
            $_SESSION["_message"] = [
                "message" => "Пост не был удален. Возможно произошла какая-то ошибка!",
                "type" => "error"
            ];
        }

        Router::redirect("/admin");
    }

    public function updateIndex(): void {
        $post = $this->service->getOne(intval($_GET["id"]));

        $this->view("posts.update", [
            "post" => $post
        ]);
    }

    public function update() {
        $controllerData = [];

        $newPost = [
            "id" => $_POST["id"],
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
            $result = $this->service->update($newPost["id"], $newPost["title"], $newPost["description"], $newPost["img"]);

            if ($result !== false) {
                AlertMessage::setMessage("Пост успешно изменен!", "success");
            } else {
                AlertMessage::setMessage("Произошла непредвиденная ошибка!", "error");
                $controllerData = [
                    "post" => $newPost
                ];
            }
        } else {
            $controllerData = [
                "post" => $newPost,
                "validation" => $validator->getErrors()
            ];
        }

        if (empty($controllerData)) {
            Router::redirect("/admin");
        } else {
            $this->view("posts.update", $controllerData);
        }
    }
}