<?php

class Home extends Controller
{    
    public function index()
    {
        $data['username'] = empty($_SESSION['user']) ? 'User' : $_SESSION['user']->email;
        // $data['title'] = 'Home';

        

        $this->view('layout/header', $data);
        $this->view('layout/sidebar', $data);
        $this->view('home', $data);
        $this->view('layout/footer', $data);
    }
}