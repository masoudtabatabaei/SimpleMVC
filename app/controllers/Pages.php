<?php


class Pages extends controller
{
    public function index()
    {
        $this->view('pages/index' , ["title" => "Web Development"]);
    }

    public function about($id)
    {

//        echo "about function with {$id} params";
    }
}