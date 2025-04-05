<?php

class Agenda
{
    protected $table = 'tbl_agenda';
    protected $tableUser = 'tbl_user';
    protected $tableJenisAgenda = 'tbl_jenis_agenda';
    protected $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAgendas()
    {
        $this->db->query("SELECT tja.nama_jenis as jenis_agenda, ta.agenda_id, ta.assign_at, ta.status, ta.created_at, ta.approved_at, tu.nama_karyawan AS nama_karyawan, tu2.nama_karyawan as dibuat_oleh, tu3.nama_karyawan as diapprove_oleh  
        FROM $this->table ta 
        LEFT JOIN $this->tableJenisAgenda tja 
        ON ta.jenis_agenda_id = tja.jenis_agenda_id 
        LEFT JOIN $this->tableUser tu 
        ON ta.user_id = tu.user_id
        LEFT JOIN $this->tableUser tu2
        ON ta.created_by = tu2.user_id
        LEFT JOIN $this->tableUser tu3
        ON ta.approved_by = tu3.user_id 
        ORDER BY ta.created_at DESC");
        return $this->db->get();
    }

    public function save($data, $userLogin)
    {
        $query = "INSERT INTO $this->table (jenis_agenda_id, user_id, status, keterangan, assign_at, created_at, updated_at, created_by) 
        VALUES (:jenisAgendaId, :userId, 'created', :keterangan, :assignAt, current_timestamp(), current_timestamp(), :userLogin)";
        $this->db->query($query);
        $this->db->bind('jenisAgendaId', $data['jenis_agenda_id']);
        $this->db->bind('userId', $data['user_id']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('assignAt', $data['assigndate']);
        $this->db->bind('userLogin', $userLogin);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }
}
