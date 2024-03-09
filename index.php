<?php

namespace RadAir;
require_once 'autoload.php';
session_start();

$main = new Main("Мой сайт"); // Создание веб-приложения
$main->set_echo_errors(true); // Ошибки выключены
$main->set_title_NF("Страница не найдена"); // Задал название страницы 404
$main->set_Logging(true); // Включение логов

// Логика подключения страниц

$router = new Router(); // Создание маршрутизатора

$router->not_page = "pages/not_page.php"; // Путь к ненайденной странице

$router->get('/', function () use ($router) { // Новый маршрут
    $router->get_page("home.php");
});

$router->get('/home', function () {
    var_dump($_SESSION["app"]);
});

$router->startHandler();

