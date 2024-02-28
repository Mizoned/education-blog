<?php

namespace App\Components;

class AlertMessage {
    static public function setMessage($message, $type) {
        $_SESSION["_message"] = [
            "message" => $message,
            "type" => $type
        ];
    }

    static public function destroyMessage() {
        if (isset($_SESSION["_message"])) {
            unset($_SESSION["_message"]);
        }
    }

    static public function render($message, $type) {
        $alertClass = match($type) {
            "success" => "alert-success",
            "error" => "alert-danger",
            default => "alert-primary",
        };

        echo "
            <div class='alert alert-dismissible fade show $alertClass' role='alert'>$message</div>
        ";
    }
}