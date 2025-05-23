<?php
require_once __DIR__ . '/../config/db.php'; // Ensuring the path is correct in different directory structure

class Gadget {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ
    public function getAllGadgets() {
        $stmt = $this->db->query("SELECT * FROM gadgets");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SEARCH - renamed to getGadgets
    public function getGadgets($searchTerm) {
        $searchTerm = "%" . $searchTerm . "%";
        $stmt = $this->db->prepare("SELECT * FROM gadgets WHERE name LIKE ?");
        $stmt->execute([$searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function addGadget($name, $description, $gadget_number, $quantity) {
        $stmt = $this->db->prepare("INSERT INTO gadgets (name, description, gadget_number, quantity) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $gadget_number, $quantity]);
    }

    // UPDATE
    public function updateGadget($id, $name, $description, $gadget_number, $quantity) {
        $stmt = $this->db->prepare("UPDATE gadgets SET name = ?, description = ?, gadget_number = ?, quantity = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $gadget_number, $quantity, $id]);
    }

    // DELETE
    public function deleteGadget($id) {
        $stmt = $this->db->prepare("DELETE FROM gadgets WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
