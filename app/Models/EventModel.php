<?php
namespace App\Models;

use App\Database;

class EventModel {
    private $conn;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection();
    }

    public function addEnrollment($username, $eventno) {
        $query = "INSERT INTO enroll (username, eventno) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $username, $eventno);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function removeEnrollment($username, $eventno) {
        $query = "DELETE FROM enroll WHERE username = ? AND eventno = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $username, $eventno);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function isUserEnrolled($username, $eventno) {
        $query = "SELECT * FROM enroll WHERE username = ? AND eventno = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $username, $eventno);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    }

    public function getEvent($no) {
        $query = "SELECT * FROM events WHERE no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $no);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc();
    }

    public function getAllEvents() {
        $query = "SELECT * FROM events";
        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllupcomingEvents() {
        $query = "SELECT * FROM events WHERE date >= CURDATE()";
        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
