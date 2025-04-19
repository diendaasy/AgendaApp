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
            Flasher::setFlash('error', 'Registrasi Gagal', 'Nama lengkap wajib diisi');
            header('Location:' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['username']))) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'Username wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['jabatan']))) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'Jabatan wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['tanggal_lahir']))) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'Tanggal Lahir wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['jenis_kelamin']))) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'Jenis kelamin wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['password']))) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'Password wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (empty(trim($_POST['confirm_password']))) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'Konfirmasi password wajib diisi');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'password dan Konfirmasi password harus sama');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if ($this->model('User')->existsUsername(trim($_POST['username'])) > 0) {
            Flasher::setFlash('error', 'Registrasi Gagal', 'Username telah terdaftar');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
        if ($this->model('User')->register($_POST) > 0) {
            Flasher::setFlash('success', 'Registrasi Berhasil', 'Akun berhasil didaftarkan');
            header('Location: ' . APP_URL . '/users');
            exit;
        } else {
            Flasher::setFlash('error', 'Registrasi Gagal', '');
            header('Location: ' . APP_URL . '/users/create');
            exit;
        }
    }

    public function edit($id)
    {
        $this->view('templates/header');
        $data['judul'] = ' Edit User';
        $data['user'] = $this->model('User')->getUserById($id);
        $this->view('user/edit', $data);
        $this->view('templates/footer');
    }

    public function update($id)
    {
        $user = $this->model('User')->getUserById($id);
        if (empty(trim($_POST['nama_karyawan']))) {
            Flasher::setFlash('error', 'Ubah Data User Gagal', 'Nama lengkap wajib diisi');
            header('Location:' . APP_URL . '/users/edit/' . $id);
            exit;
        }
        if (empty(trim($_POST['jabatan']))) {
            Flasher::setFlash('error', 'Ubah Data User Gagal', 'Jabatan wajib diisi');
            header('Location: ' . APP_URL . '/users/edit/' . $id);
            exit;
        }
        if (empty(trim($_POST['tanggal_lahir']))) {
            Flasher::setFlash('error', 'Ubah Data User Gagal', 'Tanggal Lahir wajib diisi');
            header('Location: ' . APP_URL . '/users/edit/' . $id);
            exit;
        }
        if (empty(trim($_POST['jenis_kelamin']))) {
            Flasher::setFlash('error', 'Ubah Data User Gagal', 'Jenis kelamin wajib diisi');
            header('Location: ' . APP_URL . '/users/edit/' . $id);
            exit;
        }
        if ($this->model('User')->update($id, $_POST) > 0) {
            Flasher::setFlash('success', 'Ubah Data User Berhasil', 'Akun berhasil diubah');
            header('Location: ' . APP_URL . '/users');
            exit;
        } else {
            Flasher::setFlash('error', 'Ubah Data User Gagal', '');
            header('Location: ' . APP_URL . '/users/edit/' . $id);
            exit;
        }
    }

    public function delete($id)
    {
        $this->adminAuthorization();
        if ($this->model('user')->deleteById($id) > 0) {
            Flasher::setFlash('success', 'User Berhasil Dihapus', '');
            header('Location: ' . APP_URL . '/users');
            exit;
        } else {
            Flasher::setFlash('error', 'User Gagal Dihapus', '');
            header('Location:' . APP_URL . '/users');
            exit;
        }
    }
}
