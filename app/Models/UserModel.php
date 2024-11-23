<?php

namespace App\Models;

use App\Database;

class UserModel {
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
    //create a function to insert the data of RolerRequest.php
    /*public function insertRoleRequest($username, $email, $role, $reason, $status,Database $database) {
        $conn = $database->getConnection();

        $sql = "INSERT INTO rolereq (username, email, role, reason, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $role, $reason, $status);
        echo "<script> alert('data giya'); </script>";
        $stmt->execute();
        $stmt->close();

        return true;
    }*/
    public function insertRoleRequest($username, $email, $role, $reason, $status,Database $database) {
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

    public function updateRoleRequest($username, $email, $role, $reason, $status,Database $database) {
        $conn = $database->getConnection();
        $sql = "UPDATE rolereq set email=?, role=?, reason=?, status=? where username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $email, $role, $reason, $status, $username);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    
}
?>