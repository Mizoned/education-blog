<?php

namespace Core\Classes\Middlewares;

class Guest {
    public function handle() {
        if (\Core\Classes\Helper::checkAuth()) {
            \Core\Classes\Router::redirect("/");
        }
    }
}
