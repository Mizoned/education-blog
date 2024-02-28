<?php
    use Core\Classes\Router;
    use \App\Controllers\PostController;
    use \App\Controllers\AuthController;
    use \App\Controllers\AdminController;

    $router = new Router();

    $middlewareList = [
        "auth" => Core\Classes\Middlewares\Auth::class,
        "guest" => Core\Classes\Middlewares\Guest::class
    ];

    $router->setMiddlewareList($middlewareList);

    $router->get("", [PostController::class, "index"]);
    $router->get("posts", [PostController::class, "detail"]);
    $router->get("posts/create", [PostController::class, "createIndex"])->only('auth');
    $router->post("posts", [PostController::class, "create"])->only('auth');
    $router->delete("posts", [PostController::class, "destroy"])->only('auth');
    $router->get("posts/update", [PostController::class, "updateIndex"])->only('auth');
    $router->update("posts", [PostController::class, "update"])->only('auth');

    $router->add("sign-in", [AuthController::class, "signIn"], ['GET', 'POST'])->only('guest');
    $router->add("sign-up", [AuthController::class, "signUp"], ['GET', 'POST'])->only('auth');
    $router->get("logout", [AuthController::class, "logout"])->only('auth');

    $router->get("admin", [AdminController::class, "index"])->only('auth');

    return $router;