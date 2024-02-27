<?php
    use Core\Classes\Router;
    use \App\Controllers\PostController;
    use \App\Controllers\AuthController;

    $router = new Router();

    $router->get("", [PostController::class, "index"]);
    $router->get("posts", [PostController::class, "detail"]);
    $router->get("posts/create", [PostController::class, "create"]);
    $router->post("posts", [PostController::class, "store"]);
    $router->get("sign-in", [AuthController::class, "signIn"])->only('guest');
    $router->get("sign-up", [AuthController::class, "signUp"])->only('guest');

    return $router;