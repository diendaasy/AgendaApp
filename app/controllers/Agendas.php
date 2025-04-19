<?php

class Agendas extends Controller
{

    public function __construct()
    {
        $this->checkAuthentication();
    }

    public function index()
    {
        $this->view('templates/header');
        $data['judul'] = 'Data Agenda';
        if ($_SESSION['user']['user_role'] === 'approver') {
            $data['agenda'] = $this->model('agenda')->getAllAgendasApprover();
        } else if ($_SESSION['user']['user_role'] === 'karyawan') {
            $data['agenda'] = $this->model('agenda')->getAllAgendaForKaryawan($_SESSION['user']['user_id']);
        } else {
            $data['agenda'] = $this->model('agenda')->getAllAgendas();
        }
        $this->view('agenda/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $this->adminAuthorization();
        $this->view('templates/header');
        $data = [
            'judul' => 'Tambah agenda',
            'karyawan' => $this->model('user')->getAllKaryawan(),
            'jenisAgenda' => $this->model('jenisAgenda')->getAllJenisAgenda()
        ];
        $this->view('agenda/create', $data);
        $this->view('templates/footer');
    }

    public function createJoinAgenda()
    {
        $this->adminAuthorization();
        $this->view('templates/header');
        $data = [
            'judul' => 'Tambah agenda bersama'
        ];
        $this->view('agenda/create-join-agenda', $data);
        $this->view('templates/footer');
    }

    public function editJoinAgenda($id)
    {
        $this->adminAuthorization();
        $this->view('templates/header');
        $agenda = $this->model('agenda')->getAgendaById($id);
        $data = [
            'judul' => 'edit agenda bersama',
            'agenda' => $agenda
        ];
        $this->view('agenda/edit-join-agenda', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        $this->adminAuthorization();
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

    public function saveJoinAgenda()
    {
        if (empty(trim($_POST['assigndate']))) {
            Flasher::setFlash('error', 'Agenda Bersama Gagal Dibuat', 'Tanggal agenda wajib dipilih');
            header('Location:' . APP_URL . '/agendas/createJoinAgenda');
            exit;
        }
        if ($this->model('agenda')->saveJoinAgenda($_POST, $_SESSION['user']['user_id']) > 0) {
            Flasher::setFlash('success', 'Agenda Bersama Berhasil Dibuat', 'Agenda Bersama berhasil didaftarkan');
            header('Location: ' . APP_URL . '/agendas');
            exit;
        } else {
            Flasher::setFlash('error', 'Agenda Bersama Gagal Dibuat', '');
            header('Location:' . APP_URL . '/agendas/createJoinAgenda');
            exit;
        }
    }

    public function updateJoinAgenda($id)
    {
        if (empty(trim($_POST['assigndate']))) {
            Flasher::setFlash('error', 'Agenda Bersama Gagal Diperbarui', 'Tanggal agenda wajib dipilih');
            header('Location:' . APP_URL . '/agendas/create');
            exit;
        }
        if ($this->model('agenda')->updateJoinAgendaById($id, $_SESSION['user']['user_id'], $_POST) > 0) {
            Flasher::setFlash('success', 'Agenda Bersama Berhasil Diperbarui', 'Agenda Bersama berhasil Diperbarui');
            header('Location: ' . APP_URL . '/agendas');
            exit;
        } else {
            Flasher::setFlash('error', 'Agenda Bersama Gagal Diperbarui', '');
            header('Location:' . APP_URL . '/agendas/create');
            exit;
        }
    }

    public function approve($id)
    {
        $this->approverAuthorization();
        if ($this->model('agenda')->approve($id, $_SESSION['user']['user_id']) > 0) {
            Flasher::setFlash('success', 'Agenda Berhasil Diapprove', '');
            header('Location: ' . APP_URL . '/agendas');
            exit;
        } else {
            Flasher::setFlash('error', 'Agenda Gagal Diapprove', '');
            header('Location:' . APP_URL . '/agendas');
            exit;
        }
    }
    public function reject($id)
    {
        $this->approverAuthorization();
        header('Content-Type: application/json');
        $reason = $_POST['reason'];
        if (empty(trim($reason))) {
            Flasher::setFlash('error', 'Agenda Gagal Diapprove', 'Alasan Penolakan wajib diisi');
            echo json_encode([
                'status' => 'erorr',
                'redirect' => APP_URL . '/agendas',
                'message' => 'Alasan Penolakan wajib diisi'
            ]);
            return;
        }
        if ($this->model('agenda')->reject($id, $_SESSION['user']['user_id'], $reason) > 0) {
            Flasher::setFlash('success', 'Agenda Berhasil Ditolak', '');
            echo json_encode([
                'status' => 'success',
                'redirect' => APP_URL . '/agendas',
                'message' => 'Agenda Berhasil ditolak'
            ]);
            return;
        } else {
            Flasher::setFlash('error', 'Agenda Gagal ditolak', '');
            echo json_encode([
                'status' => 'erorr',
                'redirect' => APP_URL . '/agendas',
                'message' => 'Agenda Gagal ditolak'
            ]);
            return;
        }
    }

    public function deleteJoinAgenda($id)
    {
        $this->adminAuthorization();
        if ($this->model('agenda')->deleteById($id) > 0) {
            Flasher::setFlash('success', 'Agenda Berhasil Dihapus', '');
            header('Location: ' . APP_URL . '/agendas');
            exit;
        } else {
            Flasher::setFlash('error', 'Agenda Gagal Dihapus', '');
            header('Location:' . APP_URL . '/agendas');
            exit;
        }
    }
}
