<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
        $this->adminAuthorization();
    }

    public function index()
    {
        $this->view('templates/header');
        $data['judul'] = ' Data User';
        $data['user'] = $this->model('User')->getAllUsers();
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $this->view('templates/header');
        $data['judul'] = 'Tambah User';
        $this->view('user/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        if (empty(trim($_POST['nama_karyawan']))) {
            Flasher::setFlash('error', 'Registrasi gagal', 'Nama lengkap wajib diisi');
            header('Location:' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['username']))) {
            Flasher::setFlash('error', 'registrasi gagal', 'Username wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['jabatan']))) {
            Flasher::setFlash('error', 'registrasi gagal', 'Jabatan wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['password']))) {
            Flasher::setFlash('error', 'registrasi gagal', 'Password wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['confirm_password']))) {
            Flasher::setFlash('error', 'registrasi gagal', 'Konfirmasi password wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
            Flasher::setFlash('error', 'registrasi gagal', 'password dan Konfirmasi password harus sama');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if ($this->model('User')->existsUsername(trim($_POST['username'])) > 0) {
            Flasher::setFlash('error', 'registrasi gagal', 'Username telah terdaftar');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if ($this->model('User')->register($_POST) > 0) {
            Flasher::setFlash('success', 'registrasi berhasil', 'Akun berhasil didaftarkan');
            header('Location: ' . APP_URL . '/users');
            exit;
        } else {
            Flasher::setFlash('error', 'registrasi gagal', '');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
    }
}
