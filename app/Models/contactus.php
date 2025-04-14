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
        $conn = $database->getConnection();
        $query = "INSERT INTO contact_support (name, id, email, contact_no, details) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $name, $type, $email, $contact_no, $feedback);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


}?>