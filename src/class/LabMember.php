<?php
require_once __DIR__ . '/../config/db.php'; //we use dir so that it can be used in any directory

class LabMember {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ
    public function getAllMembers() {
        $stmt = $this->db->query("SELECT * FROM lab_members");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SEARCH - renamed to getMembers
    public function getMembers($searchTerm) {
        $searchTerm = "%" . $searchTerm . "%";
        $stmt = $this->db->prepare("SELECT * FROM lab_members WHERE name LIKE ?");
        $stmt->execute([$searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function addMember($name, $email, $phone) {
        $stmt = $this->db->prepare("INSERT INTO lab_members (name, email, phone) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $phone]);
    }

    // UPDATE
    public function updateMember($id, $name, $email, $phone) {
        $stmt = $this->db->prepare("UPDATE lab_members SET name = ?, email = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $phone, $id]);
    }

    // DELETE
    public function deleteMember($id) {
        $stmt = $this->db->prepare("DELETE FROM lab_members WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>