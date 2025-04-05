<?php

class JenisAgenda
{
    protected $table = 'tbl_jenis_agenda';
    protected $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllJenisAgenda()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->get();
    }
}
