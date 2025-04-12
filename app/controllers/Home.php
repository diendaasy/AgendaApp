<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
    }
    public function index()
    {
        $agenda = $this->model('agenda')->getNotificationForKaryawan($_SESSION['user']['user_id']);
        $agendaKebersamaan = $this->model('agenda')->getAllAgendaKebersamaan();
        $data = [
            'agenda' => $agenda,
            'agendaKebersamaan' => $agendaKebersamaan
        ];
        $this->view('templates/header');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
