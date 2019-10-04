<?php

/**
 * Class core
 * Creates url and load core controller
 * Url format - /controller/method/params
 */


class core
{
    protected $currentController = "Pages";
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

            $this->loadRequiredController();

            if (isset($url[1])) {
                if (method_exists($this->currentController, strtolower($url[1]))) {
                    $this->currentMethod = strtolower($url[1]);
                }
            }

            unset($url[0], $url[1]);

            $this->params = $url ? array_values($url) : [];
        } else {
            $this->loadRequiredController();
        }

        return call_user_func_array(array($this->currentController, $this->currentMethod), $this->params);
    }

    private function sanitizeUrl($url)
    {
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);

        return $url;
    }

    private function loadRequiredController()
    {
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;
    }
}