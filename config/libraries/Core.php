<?php
//Core App Class
class Core
{
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function url()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
        }
    }
}
