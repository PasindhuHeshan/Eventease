<?php

class Controller
{
    public function view($name)
    {
        $filename = "../App/Views/".$name.".view.php";
        if(file_exists($filename)){
            require $filename;
        } else {
            $filename = "../App/Views/404.view.php";
            require $filename;
        }
    }
}