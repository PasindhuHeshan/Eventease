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

    public function getuserdatausingtypes() {
        $query = "SELECT roles.role_name, users.usertype, roles.role_id, COUNT(*) as count 
                  FROM users 
                  JOIN roles ON users.usertype = roles.role_id 
                  GROUP BY users.usertype";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $userdata = [];
    
        while ($data = $result->fetch_assoc()) {
            $userdata[] = $data;
        }
    
        $stmt->close();
        return $userdata;
    }
    

    public function getNewUsersByType() {
        $query = "SELECT users.*, COUNT(*) as count FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH) GROUP BY users.usertype";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $userdata = [];
        
        while ($data = $result->fetch_assoc()) {
            $userdata[$data['usertype']] = $data['count'];
        }
        
        $stmt->close();
        return $userdata;
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
        $query = "SELECT inventory.*, event_inventory.quantity as Qty, event_inventory.status, inventory.* FROM inventory LEFT JOIN event_inventory ON inventory.id = event_inventory.inventory_item WHERE inventory_type = ? Group by inventory_no";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $inventory_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function check_item($inventory_no){
        $query = "SELECT * FROM inventory WHERE inventory_no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $inventory_no);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
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
 
    public function getItemByInventoryNo($id) {
        $sql = "SELECT inventory.*, IFNULL(SUM(event_inventory.quantity), 0) as in_use 
            FROM inventory 
            LEFT JOIN event_inventory ON inventory.id = event_inventory.inventory_item 
            WHERE inventory.id = ? AND (event_inventory.status = 1 OR event_inventory.status IS NULL)
            GROUP BY inventory.id";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $id);
    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            } else {
                return false;
            }
    
            $stmt->close();
        } else {
            return false;
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
                return false;
            }
    
            $stmt->close();
        } else {
            return false;
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

    public function checkemail($email){
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addUser($fname, $lname, $email, $userType) {
        $sql = "INSERT INTO users (fname, lname, email, usertype) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $fname, $lname, $email, $userType);

            if ($stmt->execute()) {
                return true;
            } else {
                echo $stmt->error;
                return false;
            }

            $stmt->close();
        } else {
            return false;
        }
    }

    public function updatestatus($No,$status){
        $sql = "UPDATE users SET status = ? WHERE No = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("is", $status, $No);

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

    public function getUsers() {
        $sql = "SELECT No, fname, lname, email,usertype, status FROM users";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $users = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                return $users;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function insertItem($item, $inventory_no, $quantity, $inventory_type) {
        $query = "INSERT INTO items (item, inventory_no, quantity, inventory_type) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

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
}

?>
