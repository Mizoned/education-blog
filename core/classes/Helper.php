<?php

namespace Core\Classes;

class Helper {
    public static function dump($data): void {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    public static function checkAuth(): bool {
        return isset($_SESSION['user']);
    }
}