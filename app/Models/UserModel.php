<?php

namespace App\Models;

use App\Database;

class UserModel {
    private $conn;

    // public function __construct($conn) {
    //     $this->conn = $conn;
    // }

    public function validateUser($username, $password, Database $database) {
        $conn = $database->getConnection();

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createUser(
        $username, $hashedPassword, $fname, $lname, $email, 
        $usertype, $universityid, $universityregno, $address, $city,
        $contactno1, $contactno2, $profile_picture, 
        $database
    ) {
        $conn = $database->getConnection();
        // // Check if the user is a guest
        // if ($usertype === 'guest') {
        //     $universityid = null;
        //     $universityregno = null;
        // }
    
        $sql = "INSERT INTO users (
                    username, password, fname, lname, email,
                    usertype, universityid, universityregno, address, city,
                    contactno1, contactno2, profile_picture, created_at, updated_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $username, $hashedPassword, $fname, $lname, $email, 
            $usertype, $universityid, $universityregno, $address, $city,
            $contactno1, $contactno2, $profile_picture
        ]);
    }
    

    public function updateUserProfile($username, $fname, $lname, $email, $address, $city, $contactno1, $contactno2, $database) 
    {
        $conn = $database->getConnection();
        $sql = "UPDATE users SET fname = ?, lname = ?, email = ?, address = ?, city = ?, contactno1 = ?, contactno2 = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$fname, $lname, $email, $address, $city, $contactno1, $contactno2, $username]);
    }

    public function checkUser($username, Database $database) {
        $conn = $database->getConnection();

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUser2($username, Database $database) {
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT COUNT(*) AS count FROM users WHERE username = ?');
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }    

    public function getUserData($username, Database $database) {
        $conn = $database->getConnection();
    
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function fpcheck($username, $email, Database $database) {
        $conn = $database->getConnection();

        $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fpchange($username, $password, Database $database) {
        $conn = $database->getConnection();

        $sql = "UPDATE users set password=? where username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $password, $username);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function insertRoleRequest($username, $email, $role, $reason, $status, Database $database) {
        $conn = $database->getConnection();
        $sql = "INSERT INTO rolereq (username, email, role, reason, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error preparing SQL: " . $conn->error);
        }
    
        $stmt->bind_param("sssss", $username, $email, $role, $reason, $status);
    
        if ($stmt->execute() === false) {
            die("Error executing SQL: " . $stmt->error);
        }
    
        $stmt->close();
        return true;
    }

    public function getRoleRequest(Database $database, $username){
        $conn = $database->getConnection();
        $sql = "SELECT * FROM rolereq WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    public function updateRoleRequest($username, $email, $role, $reason, $status, Database $database) {
        $conn = $database->getConnection();
        $sql = "UPDATE rolereq set email=?, role=?, reason=?, status=? where username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $email, $role, $reason, $status, $username);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function updateProfilePicture($username, $profilePicturePath, Database $database) { 
        $conn = $database->getConnection();
        
        $sql = "UPDATE users SET profile_picture = ? WHERE username = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("ss", $profilePicturePath, $username); 
        $stmt->execute(); 
        $stmt->close();
    }

    public function deleteRoleRequest($username, Database $database) {
        $conn = $database->getConnection();
        $sql = "DELETE FROM rolereq WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function usernameExists($username, Database $database) {
        $conn = $database->getConnection();
    
        $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        return $row['count'] > 0;
    }
}
?>
