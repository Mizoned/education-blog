<?php
    use Core\Classes\Router;

    $router = new Router();

    $router->register('', 'PostController', 'index');
    $router->register('posts', 'PostController', 'detail');
    $router->register('sign-in', 'AuthController', 'signIn');
    $router->register('sign-up', 'AuthController', 'signUp');

    return $router;