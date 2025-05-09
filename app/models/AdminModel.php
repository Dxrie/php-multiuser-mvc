<?php
class AdminModel
{
    private $tableAdmin = "tb_admins";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getByUsername($username)
    {
        $this->db->query("SELECT * FROM $this->tableAdmin WHERE name = :name");
        $this->db->bind(":name", $username);
        return $this->db->single();
    }
}
