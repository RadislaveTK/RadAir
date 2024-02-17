<?php
class Main
{
    public $title = "";
    public $page = "";
    public $title_nf = "";
    public $url = "";
    private $errors = false;

    function __construct($title, $errors_bool = false, $title_nf = "not found")
    {
        session_start();
        require_once("Router.php");
        $this->title = $title;
        $this->errors = $errors_bool;
        $this->title_nf = $title_nf;

        // (включение/выключение ошибок)
        if ($errors_bool)
            ini_set('display_errors', 'On');
        else
            ini_set('display_errors', 'Off');

        // Логика для подключения файлов
        if ($_SERVER['REQUEST_URI'] == '/')
            $this->page = 'home';
        else {
            $this->page = $_SERVER['REQUEST_URI'];
            $this->page = explode('?', $this->page);
            $this->page = substr($this->page[0], 1);
            $this->url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
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
    }

    
}
