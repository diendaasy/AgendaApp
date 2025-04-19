<?php

class User
{
    protected $table = 'tbl_user';
    protected $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function login($data)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username AND password = :password');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        return $this->db->first();
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }
    public function existsUsername($username)
    {
        $this->db->query("SELECT username FROM $this->table WHERE username = :username");
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCountAffected();
    }
    public function register($data)
    {
        $query = "INSERT INTO $this->table (user_role, username, password, nama_karyawan, jabatan, tanggal_lahir, jenis_kelamin, created_at, updated_at) VALUES ('karyawan', :username, :password, :nama_karyawan, :jabatan, :tanggal_lahir, :jenis_kelamin, current_timestamp(), current_timestamp())";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('nama_karyawan', $data['nama_karyawan']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->execute();

        return $this->db->rowCountAffected();
    }

    public function getAllKaryawan()
    {
        $this->db->query("SELECT * FROM $this->table WHERE user_role = 'karyawan'");
        return $this->db->get();
    }

    public function getAllApprover()
    {
        $this->db->query("SELECT * FROM $this->table WHERE user_role = 'approver'");
        return $this->db->get();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id = :id ');
        $this->db->bind('id', $id);
        return $this->db->first();
    }

    public function update($id, $data)
    {
        $query = "UPDATE $this->table SET nama_karyawan = :nama_karyawan, jabatan = :jabatan, tanggal_lahir = :tanggal_lahir, jenis_kelamin = :jenis_kelamin, updated_at = current_timestamp() WHERE user_id = :id ";
        $this->db->query($query);
        $this->db->bind('nama_karyawan', $data['nama_karyawan']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCountAffected();
    }

    public function deleteById($id)
    {
        $this->db->query("DELETE FROM $this->table WHERE user_id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCountAffected();
    }
}
