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
        $query = "INSERT INTO $this->table VALUES ('', 'karyawan', :username, :password, :nama_karyawan, :jabatan, current_timestamp(), current_timestamp())";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('nama_karyawan',$data ['nama_karyawan']);
        $this->db->bind('jabatan',$data ['jabatan']);
        $this->db->execute();

        return $this->db->rowCountAffected();
    }
}
