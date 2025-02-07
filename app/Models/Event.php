<?php
namespace App\Models;

use App\Database;

class Event {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getEvent($no) {
        $query = "SELECT * FROM events WHERE no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $no);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUpcomingEvents($username) {
        $query = "
            SELECT e.name, e.date, e.time 
            FROM enroll en
            JOIN events e ON en.eventno = e.no
            WHERE en.username = ? AND e.date >= CURDATE()
            ORDER BY e.date ASC, e.time ASC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    //write a function to insert contact us form data into the database
    public function insertContactUs($type, $email, $contact_no, $feedback) {
        $query = "INSERT INTO contact_support (type, email, contact_no, feedback) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $type, $email, $contact_no, $feedback);
        return $stmt->execute();
    }
}
?>
