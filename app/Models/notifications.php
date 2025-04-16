<?php

namespace App\Models;

use App\Database;

class notifications {

    public function checknewchat($email, Database $database) {
        $conn = $database->getConnection();
        $query = "SELECT * FROM contact_support where email=? and open_time < reply_time";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function checknewchatforadmin(Database $database) {
        $conn = $database->getConnection();
        $query = "SELECT * FROM contact_support where open_time > reply_time";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

}