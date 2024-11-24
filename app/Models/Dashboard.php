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

    public function getInventoryByType($inventory_type) {
        $query = "SELECT * FROM inventory WHERE inventory_type = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $inventory_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function save_item($item, $inventory_no, $quantity, $inventory_type) {
        $sql = "INSERT INTO inventory (item, inventory_no, quantity, inventory_type) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssis", $item, $inventory_no, $quantity, $inventory_type);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

            $stmt->close();
        } else {
            return false;
        }
    }

    public function delete_item($inventory_no) {
        $query = "DELETE FROM inventory WHERE inventory_no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $inventory_no);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }
    
    
    public function getItemByInventoryNo($inventoryNo) {
        $sql = "SELECT * FROM inventory WHERE inventory_no = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $inventoryNo);
    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            } else {
                return false; // Error fetching item
            }
    
            $stmt->close();
        } else {
            return false; // Error preparing statement
        }
    }
    
    
    
    
    public function retrieve_item_data($inventoryNo) {
        $sql = "SELECT * FROM inventory WHERE inventory_no = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $inventoryNo);
    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            } else {
                return false; // Error fetching item
            }
    
            $stmt->close();
        } else {
            return false; // Error preparing statement
        }
    }

    public function modify_item($inventoryNo, $item, $quantity, $inventoryType) {
        $sql = "UPDATE inventory SET item = ?, quantity = ?, inventory_type = ? WHERE inventory_no = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("siss", $item, $quantity, $inventoryType, $inventoryNo);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }

            $stmt->close();
        } else {
            return false;
        }
    }
}

?>
