<?php

spl_autoload_register(function ($class) {
    // Замените "namespace\\" на префикс вашего пространства имен
    $prefix = 'RadAir';
    $baseDir = __DIR__ . '/radair';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Класс не принадлежит этому пространству имен
        return;
    }

    // Получаем относительное имя класса
    $relativeClass = substr($class, $len);

    // Заменяем пространство имен префикса на базовый каталог
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Если файл существует, подключаем его
    if (file_exists($file)) {
        require $file;
    }
});