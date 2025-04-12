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
        $this->db->query("SELECT tja.nama_jenis as jenis_agenda, ta.keterangan, ta.agenda_id, ta.assign_at, ta.status, ta.created_at, ta.approved_at, tu.nama_karyawan AS nama_karyawan, tu2.nama_karyawan as dibuat_oleh, tu3.nama_karyawan as diapprove_oleh  
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

    public function saveJoinAgenda($data, $userLogin)
    {
        $query = "INSERT INTO $this->table (status, keterangan, assign_at, created_at, updated_at, created_by, approved_at, approved_by) 
        VALUES ('approved', :keterangan, :assignAt, current_timestamp(), current_timestamp(), :userLogin, current_timestamp(), :userLogin)";
        $this->db->query($query);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('assignAt', $data['assigndate']);
        $this->db->bind('userLogin', $userLogin);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    public function getAllAgendasNeedApproval()
    {
        $this->db->query("SELECT tja.nama_jenis as jenis_agenda, ta.keterangan, ta.agenda_id, ta.assign_at, ta.status, ta.created_at, ta.approved_at, tu.nama_karyawan AS nama_karyawan, tu2.nama_karyawan as dibuat_oleh, tu3.nama_karyawan as diapprove_oleh  
        FROM $this->table ta 
        LEFT JOIN $this->tableJenisAgenda tja 
        ON ta.jenis_agenda_id = tja.jenis_agenda_id 
        LEFT JOIN $this->tableUser tu 
        ON ta.user_id = tu.user_id
        LEFT JOIN $this->tableUser tu2
        ON ta.created_by = tu2.user_id
        LEFT JOIN $this->tableUser tu3
        ON ta.approved_by = tu3.user_id 
        WHERE ta.approved_at IS NULL 
        ORDER BY ta.created_at DESC");
        return $this->db->get();
    }

    public function approve($id, $approver)
    {
        $query = "UPDATE $this->table SET status = 'approved', approved_at = current_timestamp(), approved_by = :approver WHERE agenda_id = :agendaId";
        $this->db->query($query);
        $this->db->bind('agendaId', $id);
        $this->db->bind('approver', $approver);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    public function reject($id, $approver, $reason)
    {
        $query = "UPDATE $this->table SET status = 'rejected', approved_at = current_timestamp(), approved_by = :approver, reject_reason = :reason WHERE agenda_id = :agendaId";
        $this->db->query($query);
        $this->db->bind('agendaId', $id);
        $this->db->bind('approver', $approver);
        $this->db->bind('reason', $reason);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    public function getAllAgendaForKaryawan($userId)
    {
        $this->db->query("SELECT tja.nama_jenis as jenis_agenda, ta.keterangan, ta.agenda_id, ta.assign_at, ta.status, ta.created_at, ta.approved_at, tu.nama_karyawan AS nama_karyawan, tu2.nama_karyawan as dibuat_oleh, tu3.nama_karyawan as diapprove_oleh  
        FROM $this->table ta 
        LEFT JOIN $this->tableJenisAgenda tja 
        ON ta.jenis_agenda_id = tja.jenis_agenda_id 
        LEFT JOIN $this->tableUser tu 
        ON ta.user_id = tu.user_id
        LEFT JOIN $this->tableUser tu2
        ON ta.created_by = tu2.user_id
        LEFT JOIN $this->tableUser tu3
        ON ta.approved_by = tu3.user_id 
        WHERE ta.approved_at IS NOT NULL 
        AND ta.status = 'approved' 
        AND ta.user_id = :userId 
        ORDER BY ta.created_at DESC");
        $this->db->bind('userId', $userId);
        return $this->db->get();
    }

    public function getNotificationForKaryawan($userId)
    {
        $this->db->query("SELECT tja.nama_jenis AS jenis_agenda, ta.keterangan, tu.nama_karyawan AS nama_pembuat, ta.assign_at 
            FROM $this->table ta 
            JOIN $this->tableJenisAgenda tja 
            ON ta.jenis_agenda_id = tja.jenis_agenda_id 
            JOIN $this->tableUser tu 
            ON ta.created_by =tu.user_id
            WHERE ta.approved_at IS NOT NULL 
            AND ta.status = 'approved' 
            AND ta.user_id = :userId 
            AND ta.assign_at = CURRENT_DATE");
        $this->db->bind('userId', $userId);
        return $this->db->get();
    }

    public function getAgendaById($id)
    {
        $this->db->query("SELECT agenda_id, assign_at, keterangan FROM $this->table WHERE agenda_id = :agendaId");
        $this->db->bind('agendaId', $id);
        return $this->db->first();
    }

    public function updateJoinAgendaById($id, $userId, $data)
    {
        $query = "UPDATE $this->table SET assign_at = :assignAt, keterangan = :keterangan, updated_at = current_timestamp(), updated_by = :userLogin WHERE agenda_id = :agendaId";
        $this->db->query($query);
        $this->db->bind('agendaId', $id);
        $this->db->bind('assignAt', $data['assigndate']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('userLogin', $userId);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }

    public function deleteById($id)
    {
        $this->db->query("DELETE FROM $this->table WHERE agenda_id = :agendaId");
        $this->db->bind('agendaId', $id);
        $this->db->execute();

        return $this->db->rowCountAffected();
    }

    public function getAllAgendaKebersamaan()
    {
        $this->db->query("SELECT keterangan, assign_at FROM $this->table WHERE jenis_agenda_id IS NULL");
        return $this->db->get();
    }
}
