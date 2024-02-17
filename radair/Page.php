<?php
class Page
{
    public $title = '';
    private $module = "";
    public $url = "";

    function __construct($title)
    {
        $this->title = $title;
        $_SESSION['title'] = $title;
        $this->url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->module = parse_url($this->url, PHP_URL_QUERY);
        $_SESSION['parms'] = $this->module;
    }

    public function top($top) {
        include $top;
    }
    public function header($header) {
        include $header;
    }
    public function footer($footer) {
        include $footer;
    }
    public function bottom($bottom) {
        include $bottom;
    }

    public function module()
    {
        parse_str($this->module, $output);
        return $output;
    }

    function __destruct()
    {

        unset($_SESSION["title"]);
        unset($_SESSION["parms"]);
        session_write_close();
    }
}
