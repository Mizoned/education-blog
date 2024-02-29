<?php

namespace App\Controllers;

use App\Components\AlertMessage;
use App\Services\AuthService;
use Core\Classes\Controller;
use Core\Classes\Router;
use Core\Classes\Validator;

class AuthController extends Controller {
    private AuthService $service;

    public function __construct() {
        $this->service = new AuthService();
    }

    public function signIn(): void {
        $controllerData = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $candidate = $this->service->findOneByEmail($_POST["email"]);

            $userData = [
                "email" => $_POST["email"],
                "password" => $_POST["password"]
            ];

            $rules = [
                "email" => ["required", "email"],
                "password" => ["required", "min:8", "max:12"]
            ];

            $messages = [
                "email" => [
                    'required' => "Поле не должно быть пустым",
                    'email' => "Поле не является электронным адресом"
                ],
                "password" => [
                    'required' => "Поле не должно быть пустым",
                    "min" => "Пароль должен быть больше :min символов",
                    "max" => "Пароль должен быть меньше :max символов"
                ],
            ];

            $validator = new Validator($userData, $rules, $messages);

            if (!empty($candidate)) {
                $validator->validate();

                if (!$validator->hasErrors()) {
                    if (password_verify($_POST["password"], $candidate["password"])) {
                        $_SESSION["user"] = [
                            "email" => $candidate["email"],
                            "name" => $candidate["name"] ?? NULL
                        ];

                        Router::redirect("/");
                    } else {
                        $validator->addError("email", "Неправильный email или пароль");
                        $validator->addError("password", "Неправильный email или пароль");
                    }
                }
            } else {
                $validator->addError("email", "Пользователь с таким email не зарегистрирован");
            }

            $controllerData = [
                "user" => $userData,
                "validation" => $validator->getErrors()
            ];
        }

        $this->view("auth.sign-in", $controllerData);
    }

    public function signUp() {
        $controllerData = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $candidate = $this->service->findOneByEmail($_POST["email"]);

            $userData = [
                "name" => $_POST["name"],
                "email" => $_POST["email"],
                "password" => $_POST["password"]
            ];

            $rules = [
                "name" => ["required", "min:2", "max:30"],
                "email" => ["required", "email"],
                "password" => ["required", "min:8", "max:12"]
            ];

            $messages = [
                "name" => [
                    'required' => "Поле не должно быть пустым",
                    "min" => "Имя пользователя должено быть больше :min символов",
                    "max" => "Имя пользователя должено быть меньше :max символов"
                ],
                "email" => [
                    'required' => "Поле не должно быть пустым",
                    'email' => "Поле не является электронным адресом"
                ],
                "password" => [
                    'required' => "Поле не должно быть пустым",
                    "min" => "Пароль должен быть больше :min символов",
                    "max" => "Пароль должен быть меньше :max символов"
                ],
            ];

            $validator = new Validator($userData, $rules, $messages);

            if (empty($candidate)) {
                $validator->validate();

                if (!$validator->hasErrors()) {
                    $result = $this->service->create($userData["name"], $userData["email"], $userData["password"]);

                    if ($result !== false) {
                        AlertMessage::setMessage("Новый пользователь успешно создан!", "success");

                        Router::redirect("/users");
                    } else {
                        AlertMessage::setMessage("Произошла непредвиденная ошибка!", "error");
                    }
                }
            } else {
                $validator->addError("email", "Пользователь с таким email уже зарегистрирован");
            }

            $controllerData = [
                "user" => $userData,
                "validation" => $validator->getErrors()
            ];
        }

        $this->view('auth.sign-up', $controllerData);
    }

    public function logout() {
        unset($_SESSION["user"]);

        Router::redirect("/");
    }
}