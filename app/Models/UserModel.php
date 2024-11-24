<?php

namespace App\Models;

use App\Database;

class UserModel {

    private $database;
    private $conn;

    public function __construct(Database $database) {
        $this->conn = $database->getConnection();
    }

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

    public function checkUser($username, $password, Database $database) {
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

    public function updateProfilePicture($username, $profilePicturePath) { 
        $sql = "UPDATE users SET profile_picture = ? WHERE username = ?"; 
        $stmt = $this->conn->prepare($sql); 
        $stmt->bind_param("ss", $profilePicturePath, $username); 
        $stmt->execute(); 
        $stmt->close();
    }
}
?>