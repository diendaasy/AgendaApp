<?php

class Auth extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            header('Location:' . APP_URL);
            exit;
        }
        $this->view('auth/login');
    }
    public function login()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            header('Location:' . APP_URL);
            exit;
        }
        if (empty(trim($_POST['username']))) {
            Flasher::setFlash('error', 'Login Gagal', 'Username wajib diisi');
            header('Location:' . APP_URL . '/auth');
            exit;
        }
        if (empty(trim($_POST['password']))) {
            Flasher::setFlash('error', 'Login Gagal', 'Password wajib diisi');
            header('Location:' . APP_URL . '/auth');
            exit;
        }

        $user = $this->model('user')->login($_POST);
        if ($user) {
            $_SESSION['user'] = $user;
            Flasher::setFlash('success', 'Login Berhasil', '');
            header('Location:' . APP_URL);
            exit;
        } else {
            Flasher::setFlash('error', 'Login Gagal', 'Username / Password Salah');
            header('Location:' . APP_URL . '/auth');
            exit;
        }
    }
    public function logout()
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location:' . APP_URL . '/auth');
    }
}
