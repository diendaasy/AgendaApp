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
}
