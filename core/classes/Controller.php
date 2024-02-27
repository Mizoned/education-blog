<?php

namespace Core\Classes;

abstract class Controller {
    public function view($view, $data = []): void {
        $_ROOT = $data;
        $str = explode(".", $view);
        $concatStr = implode(DIRECTORY_SEPARATOR, $str);

        require_once VIWES . "/$concatStr.php";
    }
}