<?php

class Root extends Controller
{
    public function index()
    {
        $user = new User;

        $arr['username'] = "super user";
        $arr['password'] = "super user";
        $arr['email'] = "super user";


        $result  = $user->findAll();
        show($result);

        $this->view('home');
    }
}