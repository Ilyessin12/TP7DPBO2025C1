<?php
require_once __DIR__ . '/../config/db.php'; // we use dir so that it can be used in any directory

class Experiment {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ
    public function getAllExperiments() {
        $stmt = $this->db->query("SELECT e.*, g.name as gadget_name, m.name as member_name 
                                  FROM experiments e
                                  JOIN gadgets g ON e.gadget_id = g.id
                                  JOIN lab_members m ON e.member_id = m.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SEARCH - renamed to getExperiments
    public function getExperiments($memberName = '', $gadgetName = '') {
        $query = "SELECT e.*, g.name as gadget_name, m.name as member_name 
                  FROM experiments e
                  JOIN gadgets g ON e.gadget_id = g.id
                  JOIN lab_members m ON e.member_id = m.id
                  WHERE 1=1";
        
        $params = [];
        
        if (!empty($memberName)) {
            $query .= " AND m.name LIKE ?";
            $params[] = "%" . $memberName . "%";
        }
        
        if (!empty($gadgetName)) {
            $query .= " AND g.name LIKE ?";
            $params[] = "%" . $gadgetName . "%";
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function addExperiment($gadget_id, $member_id, $start_date, $end_date = null) {
        $stmt = $this->db->prepare("INSERT INTO experiments (gadget_id, member_id, start_date, end_date) 
                                    VALUES (?, ?, ?, ?)");
        return $stmt->execute([$gadget_id, $member_id, $start_date, $end_date]);
    }

    // UPDATE
    public function updateExperiment($id, $gadget_id, $member_id, $start_date, $end_date = null) {
        $stmt = $this->db->prepare("UPDATE experiments SET gadget_id = ?, member_id = ?, 
                                    start_date = ?, end_date = ? WHERE id = ?");
        return $stmt->execute([$gadget_id, $member_id, $start_date, $end_date, $id]);
    }

    // DELETE
    public function deleteExperiment($id) {
        $stmt = $this->db->prepare("DELETE FROM experiments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
