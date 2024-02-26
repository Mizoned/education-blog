<?php
spl_autoload_register(function($class) {
    // Префиксы для различных пространств имен и соответствующие директории
    $prefixes = [
        'Core\\Classes\\' => CLASSES,
        'App\\Controllers\\' => CONTROLLERS,
        'App\\Services\\' => SERVICES,
        'App\\Models\\' => MODELS,
        'App\\Components\\' => COMPONENTS
    ];

    // Перебираем префиксы
    foreach ($prefixes as $prefix => $base_dir) {
        // Сравниваем префикс с пространством имен класса
        $len = strlen($prefix);

        if (strncmp($prefix, $class, $len) === 0) {
            // Получаем относительное имя класса
            $relative_class = substr($class, $len);
            // Формируем имя файла
            $file = $base_dir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . ".php";
            // Если файл существует, подключаем его
            if (file_exists($file)) {
                require_once($file);
                return;
            }
        }
    }
});