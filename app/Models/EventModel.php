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
    
    public function getNotApprovedEventsforadmin() {
        $query = " SELECT COUNT(DISTINCT e.no) AS event_count
        FROM event_inventory ei
        JOIN events e ON ei.event_id = e.no
        WHERE ei.status = 0 ";
    
    $result = $this->conn->query($query);
    if ($result && $row = $result->fetch_assoc()) {
        return (int)$row['event_count'];
    }

    return 0;
    }

    public function getNotApprovedEvents($no) {
        $query = "SELECT events.*, users.*, organizations.*, event_inventory.* FROM events JOIN users ON events.organizer = users.no JOIN organizations ON events.orgno = organizations.orgno LEFT JOIN event_inventory ON events.no = event_inventory.event_id WHERE events.approvedstatus = 1 AND (event_inventory.event_id IS NULL OR event_inventory.status = 1) AND events.supervisor = $no AND events.date >= CURDATE() GROUP BY events.no ORDER BY events.date ASC";
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

    public function changeacceptEvent($no) {
        $query = "UPDATE events set approvedstatus = 1 where no = $no";
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

    public function createEvent($name, $short_dis, $long_dis, $flag, $time, $finish_time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer) {
        $query = "INSERT INTO events (name, short_dis, long_dis, flag, time, finish_time, date, location, people_limit, event_type, approvedstatus, supervisor, event_banner, organizer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bind_param("sssissssisisss", $name, $short_dis, $long_dis, $flag, $time, $finish_time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer);
        $result = $stmt->execute(); 
        $stmt->close(); 
        return $result; 
    }

    public function updateEvent($eventno, $name, $short_dis, $long_dis, $flag, $time, $finish_time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer) {
        $query = "UPDATE events SET name = ?, short_dis = ?, long_dis = ?, flag = ?, time = ?, finish_time = ?, date = ?, location = ?, people_limit = ?, event_type = ?, approvedstatus = ?, supervisor = ?, event_banner = ?, organizer = ? WHERE no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssissssisisssi", $name, $short_dis, $long_dis, $flag, $time, $finish_time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer, $eventno);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }

    public function getEventStaffMembers($eventno) {
        $query = "SELECT event_members.*, er.event_role FROM event_members JOIN event_role as er ON er.event_role_id=event_members.event_role_id WHERE event_no = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $eventno);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEventInventory($eventno) {
        $query = "SELECT event_inventory.*, inventory.* FROM event_inventory JOIN inventory ON event_inventory.inventory_item = inventory.id WHERE event_id = ? AND event_inventory.status = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $eventno);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //admin 
    public function getadmineventinventory(Database $database){
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

    public function getEventlistforDates($start_date, $end_date) {
        $query = "SELECT * FROM events WHERE date BETWEEN ? AND ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function getEventsByStaff($staff) { 
        $query = "SELECT * FROM events join event_members as em on em.event_no=events.no WHERE em.member_id = ? "; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bind_param("s", $staff); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $stmt->close(); 
        return $result->fetch_all(MYSQLI_ASSOC); 
    }

    public function geteventsinventory($eventstart, $eventfinish, $date, Database $database) {
        $query = "SELECT inventory.id, inventory.item,
                         inventory.quantity AS total_quantity,
                         inventory.quantity - IFNULL(SUM(event_inventory.quantity), 0) AS available_quantity
                  FROM inventory
                  LEFT JOIN event_inventory ON inventory.id = event_inventory.inventory_item
                  LEFT JOIN events ON event_inventory.event_id = events.no
                  WHERE (events.date != ? OR (events.time NOT BETWEEN ? AND ? AND events.finish_time NOT BETWEEN ? AND ?))
                     OR events.no IS NULL
                  GROUP BY inventory.id";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $date, $eventstart, $eventfinish, $eventstart, $eventfinish);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function geteventtypes(Database $database){
        //table is event_inventory
        $query = "SELECT DISTINCT event.event_type from events event group by event.event_type";
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


    public function getoneeventinventory($event_id, $inventory_item, Database $database){
        $query = "SELECT ei.*, e.*, inventory.*, users.*, ei.quantity as Qty FROM event_inventory ei JOIN events e ON ei.event_id = e.no  
        JOIN inventory ON ei.inventory_item=inventory.id 
        JOIN users ON e.organizer=users.no
        WHERE ei.status = 0 AND ei.event_id = ? AND ei.inventory_item = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $event_id, $inventory_item);
        $stmt->execute();
        $result = $stmt->get_result();
        $row1 = $result->fetch_assoc();

        $query2 = "Select * from contact_numbers where Cnt_No=?";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param("i", $row1['organizer']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();

        $contactNumber = $row2 ? $row2['Cnt_num'] : "";
        $row1['contact_number'] = $contactNumber;


        if ($row1) {
            return $row1;
        } else {
            return null;
        }
    }

    public function getavailability($inventory_item,$eventstart, $eventfinish, $date, Database $database){
        $query = "SELECT * FROM event_inventory as ei JOIN events as e ON ei.event_id=e.no WHERE inventory_item = ? AND ei.status = 1 AND e.date = ? AND ((e.time NOT BETWEEN ? AND ?) OR (e.finish_time NOT BETWEEN ? AND ?))";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssss", $inventory_item, $date, $eventstart, $eventfinish, $eventstart, $eventfinish);
        $stmt->execute();
        $result1 = $stmt->get_result();

        //get sum of all rows quantity column
        $sum = 0;
        while ($row = $result1->fetch_assoc()) {
            $sum += $row['quantity'];
        }

        $query2 = "select * from inventory where id=?";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param("i", $inventory_item);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();

        $available = $row2['quantity'] - $sum;
        if ($available > 0) {
            return $available;
        } else {
            return 0;
        }

    }

    public function approveinventory($event_id, $inventory_item, Database $database){
        $query = "UPDATE event_inventory SET status = 1 WHERE event_id = ? AND inventory_item = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $event_id, $inventory_item);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function rejectinventory($event_id, $inventory_item, Database $database){
        $query = "UPDATE event_inventory SET status = 2 WHERE event_id = ? AND inventory_item = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $event_id, $inventory_item);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getsupervisors() {
        $query = "SELECT * FROM users WHERE usertype = 5";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStaffMembers() {
        $query = "SELECT * FROM users WHERE usertype = 1";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertInventoryRequest($eventno, $item, $quantity){
        $query = "INSERT INTO event_inventory (event_id, inventory_item, quantity, status) VALUES (?, ?, ?, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $eventno, $item, $quantity);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getInventorybyitem($item) {
        $query = "SELECT id FROM inventory WHERE  item = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $item);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['id'];
        } else {
            return null;
        }
    }

    public function getInventoryRequested($eventno) {
        $query = "SELECT ei.*, i.item, i.id FROM event_inventory ei JOIN inventory i ON ei.inventory_item = i.id WHERE ei.event_id = ? AND ei.status = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $eventno);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
