<?php


class Pages extends controller
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $this->view('pages/index', ["title" => "Web Development"]);
    }

    public function about($id)
    {

//        echo "about function with {$id} params";
    }
}