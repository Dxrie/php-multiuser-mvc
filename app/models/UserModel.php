<?php
class UserModel
{
    private $tableUser = "tb_users";
    private $tablePembeli = "tb_pembeli";
    private $tablePenjual = "tb_penjual";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create($data)
    {
        try {
            $query = "INSERT INTO $this->tableUser (name, email, password) VALUES (:name, :email, :password)";
            $this->db->query($query);
            $this->db->bind(":name", $data["name"]);
            $this->db->bind(":email", $data["email"]);
            $this->db->bind(":password", $data["password"]);
            $this->db->execute();

            $userId = $this->db->lastInsertId();

            $insertPembeliQuery = "INSERT INTO $this->tablePembeli (user_id, username, phone_number) VALUES (:user_id, :username, :phone_number)";
            $this->db->query($insertPembeliQuery);
            $this->db->bind(":user_id", $userId);
            $this->db->bind(":username", $data["name"]);
            $this->db->bind(":phone_number", $data["phoneNumber"]);
            $this->db->execute();

            return ["success" => true];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    public function getByUsername($username)
    {
        $this->db->query("SELECT * FROM $this->tableUser WHERE name = :name");
        $this->db->bind(":name", $username);
        return $this->db->single();
    }

    public function getRoleById($id)
    {
        $this->db->query(
            "SELECT * FROM $this->tablePenjual WHERE user_id = :id"
        );
        $this->db->bind(":id", $id);
        if ($this->db->single()) {
            return ["role" => "penjual"];
        }
        return ["role" => "pembeli"];
    }

    public function getSellerByUsername($seller_name)
    {
        $this->db->query(
            "SELECT * FROM $this->tablePenjual WHERE seller_name = :seller_name"
        );
        $this->db->bind(":seller_name", $seller_name);
        return $this->db->single();
    }

    public function registerSeller($sellerName, $description, $id)
    {
        try {
            $insertPenjualQuery = "INSERT INTO $this->tablePenjual (user_id, seller_name, description, is_active) VALUES (:user_id, :seller_name, :description, :is_active)";
            $this->db->query($insertPenjualQuery);
            $this->db->bind(":user_id", $id);
            $this->db->bind(":seller_name", $sellerName);
            $this->db->bind(":description", $description);
            $this->db->bind(":is_active", "1");
            $this->db->execute();

            return ["success" => true];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }
}
