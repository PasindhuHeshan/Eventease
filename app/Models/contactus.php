<?php

namespace App\Models;

use App\Database;

class contactus {
    private $conn;

    public function disableacc($no,$id, $contact_no, $feedback, $database){
        $conn = $database->getConnection();
        $query = "INSERT INTO admin_support (no, id, contact_no, details) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $no, $id, $contact_no, $feedback);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function feedback($name ,$type, $email, $contact_no, $feedback, $database){
        $open_time = date("Y-m-d H:i:s");
        $conn = $database->getConnection();
        $query = "INSERT INTO contact_support (name, id,email, contact_no, open_time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $name, $type,$email, $contact_no, $open_time);
        
        if ($stmt->execute()) {
            $no = $stmt->insert_id;
        } else {
            return false;
        }

        $query2 = "INSERT INTO contact_support_data (no, user_msg) VALUES (?, ?)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("ss", $no, $feedback);
        if ($stmt2->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateopentime($email, $database) {
        $conn = $database->getConnection();
        $open_time = date("Y-m-d H:i:s");
        $query = "UPDATE contact_support SET open_time=? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $open_time, $email);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertChat($no, $message, Database $database) {
        $conn = $database->getConnection();
        $query = "INSERT INTO contact_support_data (no, user_msg) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $no, $message);

        $open_time = date("Y-m-d H:i:s");
        $query2 = "UPDATE contact_support SET open_time = ? WHERE no = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("ss", $open_time, $no);

        if ($stmt->execute() && $stmt2->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function insertadminChat($no, $message, Database $database) {
        $conn = $database->getConnection();
        $query = "INSERT INTO contact_support_data (no, admin_msg) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $no, $message);

        $reply_time = date("Y-m-d H:i:s");
        $query2 = "UPDATE contact_support SET reply_time = ? WHERE no = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("ss", $reply_time, $no);

        if ($stmt->execute() && $stmt2->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getChatDetails($email, Database $database) {
    $conn = $database->getConnection();
    
    $query = "SELECT no FROM contact_support WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $chatDetails = $result->fetch_assoc();
    $stmt->close();

    if (!$chatDetails) {
        return null;
    }

    $no = $chatDetails['no'];

    $query2 = "SELECT user_msg, admin_msg, no FROM contact_support_data WHERE no = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("i", $no);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $chats = [];

    while ($row = $result2->fetch_assoc()) {
        $chats[] = $row;
    }

    $stmt2->close();

    return $chats;
}

    public function replyfeedback($row_no, $reply, Database $database) {
        $conn = $database->getConnection();
        $query = "UPDATE contact_support_data SET admin_msg = ? WHERE row_no = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $reply, $row_no);
        $stmt->execute();
        $stmt->close();

        $query2 = "SELECT no FROM contact_support_data WHERE row_no = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("s", $row_no);
        $stmt2->execute();
        $stmt2->bind_result($no);
        $stmt2->fetch();
        $stmt2->close();

        $reply_time = date("Y-m-d H:i:s");
        $query3 = "UPDATE contact_support SET reply_time = ? WHERE no = ?";
        $stmt3 = $conn->prepare($query3);
        $stmt3->bind_param("ss", $reply_time, $no);
        $success = $stmt3->execute();
        $stmt3->close();
    
        return $success;
    }
    
    

}?>