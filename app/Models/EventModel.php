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
        $query = "SELECT * FROM events WHERE no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $no);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc();
    }

    public function getAllEvents() {
        $query = "SELECT * FROM events where approvedstatus = 0";
        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUpcomingEvents($username) {
        $query = "SELECT * FROM events INNER JOIN enroll ON events.no = enroll.eventno WHERE enroll.username = ? order by date asc";
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
}
