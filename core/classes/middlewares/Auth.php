<?php

namespace Core\Classes\Middlewares;

class Auth {
    public function handle() {
        if (!\Core\Classes\Helper::checkAuth()) {
            \Core\Classes\Router::redirect("/sign-in");
        }
    }
}
