<?php

namespace App\Controllers;

use App\Components\AlertMessage;
use App\Services\PostService;
use Core\Classes\Controller;
use Core\Classes\Helper;
use Core\Classes\Router;
use Core\Classes\Validator;
use Core\Classes\File;

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

    public function create(): void {
        $newPost = $this->prepareCreatePostData();

        [$rules, $messages] = $this->getRulesAndMessagesForValidatePost();

        $validator = new Validator($newPost, $rules, $messages);
        $validator->validate();

        $controllerData = $this->processCreatePostData($newPost, $validator);

        if (empty($controllerData["validation"])) {
            Router::redirect("/admin");
        } else {
            $this->view("posts.create", $controllerData);
        }
    }

    private function prepareCreatePostData(): array {
        $newPost = [
            "title" => $_POST["title"],
            "description" => $_POST["description"],
        ];

        if (!empty($_FILES["img"]["name"])) {
            $newPost["img"] = $_FILES["img"];
        } else {
            $newPost["img"] = "";
        }

        return $newPost;
    }

    private function getRulesAndMessagesForValidatePost(): array {
        $rules = [
            "title" => ["required", "min:3", "max:100"],
            "description" => ["required"],
            "img" => ["ext:jpeg|jpg|png"],
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
            "img" => [
                "ext" => "Изображение должно соответствовать форматам: :ext"
            ]
        ];

        return [$rules, $messages];
    }

    private function processCreatePostData($postData, $validator): array {
        if (!$validator->hasErrors()) {
            $uploadedFileName = is_array($postData["img"]) ? File::upload($postData["img"]) : "";

            if ($uploadedFileName !== false) {
                $result = $this->service->create($postData["title"], $postData["description"], $uploadedFileName);

                if ($result !== false) {
                    AlertMessage::setMessage("Новый пост успешно создан!", "success");
                } else {
                    AlertMessage::setMessage("Произошла непредвиденная ошибка!", "error");
                    return ["post" => $postData];
                }
            } else {
                $validator->addError("img", "Не удалось загрузить картинку");
            }
        }

        return [
            "post" => $postData,
            "validation" => $validator->getErrors()
        ];
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
        if (isset($_GET["id"])) {
            $post = $this->service->getOne(intval($_GET["id"]));

            $this->view("posts.update", [
                "post" => $post
            ]);
        } else {
            Router::redirect("/admin");
        }
    }

    public function update() {
        $post = $this->prepareUpdatePostData();

        [$rules, $messages] = $this->getRulesAndMessagesForValidatePost();

        $validator = new Validator($post, $rules, $messages);
        $validator->validate();

        $controllerData = $this->processUpdatePostData($post, $validator);

        if (empty($controllerData["validation"])) {
            Router::redirect("/admin");
        } else {
            $this->view("posts.update", $controllerData);
        }
    }

    private function prepareUpdatePostData(): array {
        $newPost = [
            "id" => $_POST["id"],
            "title" => $_POST["title"],
            "description" => $_POST["description"]
        ];

        if (!empty($_FILES["img"]["name"])) {
            $newPost["img"] = $_FILES["img"];
        } elseif (!empty($_POST["oldImg"])) {
            $newPost["img"] = $_POST["oldImg"];
        } else {
            $newPost["img"] = "";
        }

        return $newPost;
    }

    private function processUpdatePostData($postData, $validator): array {
        if (!$validator->hasErrors()) {
            if (is_array($postData["img"])) {
                $oldFilePath = UPLOADS . "/" . $_POST["oldImg"];

                if (File::exist($oldFilePath)) {
                    if (!File::delete($oldFilePath)) {
                        $validator->addError("img", "Не удалось загрузить картинку");
                        $uploadedFileName = false;
                    } else {
                        $uploadedFileName = File::upload($postData["img"]);
                    }
                } else {
                    $uploadedFileName = File::upload($postData["img"]);
                }
            } else {
                $uploadedFileName = $postData["img"];
            }

            if ($uploadedFileName !== false) {

                $result = $this->service->update($postData["id"], $postData["title"], $postData["description"], $uploadedFileName);

                if ($result !== false) {
                    AlertMessage::setMessage("Пост успешно изменен!", "success");
                } else {
                    File::delete(UPLOADS . "/" . $uploadedFileName);

                    AlertMessage::setMessage("Произошла непредвиденная ошибка!", "error");
                    return ["post" => $postData ];
                }
            } else {
                $validator->addError("img", "Не удалось загрузить картинку");
            }
        }

        return [
            "post" => $postData,
            "validation" => $validator->getErrors()
        ];
    }
}