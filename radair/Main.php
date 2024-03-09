<?php

namespace RadAir;

use RadAir\Logger;

class Main
{
    public $title = "";
    public $page = "";
    public $title_nf = "";
    public $url = "";
    private $errors = false;
    private $startApp = false;
    private $logger;
    private $loggingEnabled;
    private $count;
    function __construct($title, $errors_bool = false, $title_nf = "not found")
    {
        if (isset($_SESSION['app'])) {
            $mainInstance = $_SESSION['app'];

            $this->title = $mainInstance->title;
            $this->page = $mainInstance->page;
            $this->title_nf = $mainInstance->title_nf;
            $this->url = $mainInstance->url;
            $this->errors = $mainInstance->errors;
            $this->startApp = $mainInstance->startApp;
            $this->logger = $mainInstance->logger;
            $this->loggingEnabled = $mainInstance->loggingEnabled;
            $this->count = $mainInstance->count;
        } else {
            $this->saveSession();
        }

        $this->title = $title;
        $this->errors = $errors_bool;
        $this->title_nf = $title_nf;

        // (включение/выключение ошибок)
        if ($errors_bool) {
            ini_set('display_errors', 'On');
            set_exception_handler([$this, 'handleException']);
        } else {
            ini_set('display_errors', 'Off');
            set_exception_handler([$this, 'handleException']);
        }

        // Логика для подключения файлов
        if ($_SERVER['REQUEST_URI'] == '/') {
            $this->page = 'home';
        } else {
            $this->page = $_SERVER['REQUEST_URI'];
            $this->page = explode('?', $this->page);
            $this->page = substr($this->page[0], 1);
            $this->url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        
        if ($this->startApp == false && $this->loggingEnabled == true) {
            $this->logger->info('Веб-приложение запущено: ' . $this->title);
            $this->startApp = true;
        }
        $this->count++;
        $this->saveSession();
    }

    private function saveSession()
    {
        $_SESSION['app'] = $this;
    }

    private function handleException(\Exception $e)
    {
        if ($this->loggingEnabled)
            $this->logger->error('Критичиская ошибка: ' . $e->getMessage());
        
        echo 'Пользовательская ошибка: ' . $e->getMessage();
    }

    public function set_Logging($enable)
    {
        if ($enable == true && !$this->loggingEnabled) {
            $this->logger = new Logger();
            $this->loggingEnabled = true;  // Добавлен флаг

        } elseif (!$enable) {
            $this->logger = null;
            $this->loggingEnabled = false;  // Выключаем логирование
        }
        $this->saveSession();
    }

    public function set_echo_errors($bool)
    {
        if ($bool)
            ini_set('display_errors', 'On');
        else
            ini_set('display_errors', 'Off');

    }

    public function set_title_NF($title)
    { // установка названия для ненайденой страницы
        $this->title_nf = $title;
        $this->saveSession();
    }

}
