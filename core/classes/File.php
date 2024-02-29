<?php

namespace Core\Classes;

class File {
    static public function delete(string $path): bool {
        if (unlink($path)) {
            return true;
        } else {
            return false;
        }
    }

    static public function upload(array $file): bool | string {
        $uniqueFilename = uniqid();
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $uniqueFilename . '.' . $fileExt;

        if ($file['error'] === 0) {
            $targetDir = UPLOADS . "/";
            $targetFilePath = $targetDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $filename;
            }
        }

        return false;
    }

    static public function exist(string $path): bool {
        if (file_exists($path)) {
            return true;
        } else {
            return false;
        }
    }
}