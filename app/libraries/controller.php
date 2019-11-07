<?php

abstract class controller
{
    abstract public function index();

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';

        return $model::getPDOInstance();
    }

    public function view($view, $data = [])
    {
        $view_path = '../app/views/' . $view . '.php';
        if (file_exists($view_path)) {
            ob_start();
            extract($data);
            require_once "$view_path";
            $result = ob_get_clean();

            echo $result;
        } else {
            die('View dose not exists.');
        }
    }
}