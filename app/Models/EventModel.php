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
    $query = "SELECT events.*, organizations.* 
              FROM events 
              JOIN organizations ON events.orgno = organizations.orgno 
              WHERE events.no = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $no);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->fetch_assoc();
}

    public function getAllEvents() {
        $query = "SELECT * FROM events WHERE approvedstatus = 0 AND date >= CURDATE()";
        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotApprovedEvents() {
        $query = "SELECT no, name, event_type FROM events WHERE approvedstatus = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $data;
    }
    

    public function acceptEvent($no) {
        $query = "UPDATE events set approvedstatus = 0 where no = $no";
        $result = $this->conn->query($query);
    
        return true;
    }
    
    public function rejectEvent($no, $reason) {
        $query = "UPDATE events SET approvedstatus = 2, reason = ? WHERE no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $reason, $no);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }
    //write a function to insert contact us form data into the database
    public function insertContactUs($type, $email, $contact_no, $feedback) {
        $query = "INSERT INTO contact_support (type, email, contact_no, feedback) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $type, $email, $contact_no, $feedback);
        return $stmt->execute();
    }
    

    public function getAllUpcomingEvents($username) {
        $query = "SELECT * FROM events INNER JOIN enroll ON events.no = enroll.eventno WHERE enroll.username = ? AND date >= CURDATE() order by date asc";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 0) {
            return null;
        }
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createEvent($name, $short_dis, $long_dis, $flag, $time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer) {
        $approvedstatus = 0; // Ensure new events are pending by default
        $query = "INSERT INTO events (name, short_dis, long_dis, flag, time, date, location, people_limit, event_type, approvedstatus, supervisor, event_banner, organizer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bind_param("sssisssisisss", $name, $short_dis, $long_dis, $flag, $time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer);
        $result = $stmt->execute(); 
        $stmt->close(); 
        return $result; 
    }

    public function updateEvent($eventno, $name, $short_dis, $long_dis, $flag, $time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer) {
        $query = "UPDATE events SET name = ?, short_dis = ?, long_dis = ?, flag = ?, time = ?, date = ?, location = ?, people_limit = ?, event_type = ?, approvedstatus = ?, supervisor = ?, event_banner = ?, organizer = ? WHERE no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssisssisisssi", $name, $short_dis, $long_dis, $flag, $time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer, $eventno);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }
    
    

    public function deleteEvent($eventno, $database) {
        $query = "DELETE FROM events WHERE no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $eventno);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getEventsByOrganizer($organizer) { 
        $query = "SELECT * FROM events WHERE organizer = ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bind_param("s", $organizer); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $stmt->close(); 
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function geteventinventory(Database $database){
        //table is event_inventory
        $query = "SELECT ei.*, e.* FROM event_inventory ei JOIN events e ON ei.event_id = e.no WHERE ei.status = 0";
        $result = $this->conn->query($query);
        if ($result === false) {
            return null;
        }
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }
    }
}
