<?php
namespace App\Models;

use App\Database;

class Dashboard {
    private $conn;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection();
    }

    public function getUserCount($user_type) {
        $query = "SELECT COUNT(*) AS count FROM users WHERE usertype = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $user_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data['count'];
    }

    public function getEventCount($event_type) {
        $query = "SELECT COUNT(*) AS count FROM events WHERE event_type = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $event_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data['count'];
    }

    public function getInventoryCount($inventory_type) {
        $query = "SELECT SUM(quantity) AS total_quantity FROM inventory WHERE inventory_type = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $inventory_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data['total_quantity'];
    }
}
?>
