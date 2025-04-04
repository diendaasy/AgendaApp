<?php

class Agendas extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
        $this->adminAuthorization();
    }

    public function index()
    {
        $this->view('templates/header');
        $data['judul'] = 'Data Agenda';
        $data['agenda'] = $this->model('agenda')->getAllAgendas();
        $this->view('agenda/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $this->view('templates/header');
        $data = [
            'judul' => 'Tambah agenda',
            'karyawan' => $this->model('user')->getAllKaryawan(),
            'jenisAgenda' => $this->model('jenisAgenda')->getAllJenisAgenda()
        ];
        $this->view('agenda/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        if (empty(trim($_POST['user_id']))) {
            Flasher::setFlash('error', 'Agenda Gagal Dibuat', 'Karyawan wajib dipilih');
            header('Location:' . APP_URL . '/agendas/create');
            exit;
        }
        if (empty(trim($_POST['jenis_agenda_id']))) {
            Flasher::setFlash('error', 'Agenda Gagal Dibuat', 'Jenis agenda wajib dipilih');
            header('Location:' . APP_URL . '/agendas/create');
            exit;
        }
        if (empty(trim($_POST['assigndate']))) {
            Flasher::setFlash('error', 'Agenda Gagal Dibuat', 'Tanggal agenda wajib dipilih');
            header('Location:' . APP_URL . '/agendas/create');
            exit;
        }
        if ($this->model('agenda')->save($_POST, $_SESSION['user']['user_id']) > 0) {
            Flasher::setFlash('success', 'Agenda Berhasil Dibuat', 'Agenda berhasil didaftarkan');
            header('Location: ' . APP_URL . '/agendas');
            exit;
        } else {
            Flasher::setFlash('error', 'Agenda Gagal Dibuat', '');
            header('Location:' . APP_URL . '/agendas/create');
            exit;
        }
    }
}
