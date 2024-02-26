<?php
    use Core\Classes\Router;
    use \App\Controllers\PostController;
    use \App\Controllers\AuthController;

    $router = new Router();

    $router->get("", [PostController::class, "index"]);
    $router->get("posts", [PostController::class, "detail"]);
    $router->get("sign-in", [AuthController::class, "signIn"]);
    $router->get("sign-up", [AuthController::class, "signUp"]);

    return $router;