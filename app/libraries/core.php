<?php

/**
 * Class core
 * Creates url and load core controller
 * Url format - /controller/method/params
 */


class core
{
    protected $currentController = "pages";
    protected $currentMethod = "index";
    protected $params = [];


    public function __construct()
    {
        return $this->getUrl();
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', $this->sanitizeUrl($_GET['url']));

            if (file_exists("../app/controllers/" . ucfirst($url[0]) . ".php")) {
                $this->currentController = ucfirst($url[0]);
            }

            require_once '../app/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;

            if (isset($url[1])) {
                if (method_exists($this->currentController, strtolower($url[1]))) {
                    $this->currentMethod = strtolower($url[1]);
                }
            }

            unset($url[0] , $url[1]);

            $this->params = $url ? array_values($url) : [];

            return call_user_func_array(array($this->currentController , $this->currentMethod) , $this->params);

        } else {
            $this->currentController = "pages";
        }
    }

    private function sanitizeUrl($url)
    {
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);

        return $url;
    }
}