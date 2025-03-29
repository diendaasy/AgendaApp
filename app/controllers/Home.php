<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
    }
    public function index()
    {
        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }
}
