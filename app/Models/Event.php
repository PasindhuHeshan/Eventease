<?php
class Event {
    private $con;

    public function __construct($db) {
        $this->con = $db;
    }

    public function getEvent($no) {
        $query = "SELECT * FROM events WHERE no = ?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $no);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
