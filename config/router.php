<?php
    use Core\Classes\Router;
    use \App\Controllers\PostController;
    use \App\Controllers\AuthController;

    $router = new Router();

    $middlewareList = [
        "auth" => Core\Classes\Middlewares\Auth::class,
        "guest" => Core\Classes\Middlewares\Guest::class
    ];

    $router->setMiddlewareList($middlewareList);

    $router->get("", [PostController::class, "index"]);
    $router->get("posts", [PostController::class, "detail"]);
    $router->get("posts/create", [PostController::class, "create"])->only('auth');
    $router->post("posts", [PostController::class, "store"])->only('auth');

    $router->add("sign-in", [AuthController::class, "signIn"], ['GET', 'POST'])->only('guest');
    $router->add("sign-up", [AuthController::class, "signUp"], ['GET', 'POST'])->only('guest');
    $router->get("logout", [AuthController::class, "logout"])->only('auth');

    return $router;