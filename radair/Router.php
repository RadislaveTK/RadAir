<?php
namespace RadAir;
class Router
{
    public $not_page = "";

    private $routes = [];

    public function get($url, $func)
    {
        $this->routes[$url] = $func;
    }

    public function get_page($name)
    {
        if (file_exists("pages/" . $name)) {
            require_once("pages/" . $name);
        }
    }

    public function startHandler()
    {
        $requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (array_key_exists($requestedPath, $this->routes)) {
            $this->routes[$requestedPath]();
        } else {
            include $this->not_page;
        }
    }

    public function get_URLs() {
        return(array_keys($this->routes));
    }

}

