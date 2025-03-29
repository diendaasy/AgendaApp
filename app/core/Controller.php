<?php

class Controller
{
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    public function checkAuthentication()
    {
        if (!$_SESSION['user']) {
            $_SESSION = [];
            session_unset();
            session_destroy();
            header("Location: " . APP_URL . '/auth');
            exit;
        }
    }
}
