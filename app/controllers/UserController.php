<?php

namespace App\Controllers;

use App\Services\UserService;
use Core\Classes\Controller;
use Core\Classes\Router;

class UserController extends Controller {

    private UserService $service;

    public function __construct() {
        $this->service = new UserService();
    }

    public function index() {
        $users = $this->service->findAll();

        $this->view("users.index", [
            "users" => $users
        ]);
    }

    public function destroy(): void {
        $userID = $_POST["id"];

        $isDeleted = $this->service->delete($userID);

        if ($isDeleted) {
            $_SESSION["_message"] = [
                "message" => "Пользователь успешно удален!",
                "type" => "success"
            ];
        } else {
            $_SESSION["_message"] = [
                "message" => "Пользователь не был удален. Возможно произошла какая-то ошибка!",
                "type" => "error"
            ];
        }

        Router::redirect("/users");
    }
}