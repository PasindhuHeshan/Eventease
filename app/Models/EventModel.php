<?php

namespace App\Models;

use App\Database;

class EventModel
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function getAllEvents()
    {
        $query = "SELECT * FROM events Order by no desc";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllupcomingEvents()
    {
        $query = "SELECT * FROM events Order by date asc";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEvent($no)
    {
        $query = "SELECT * FROM events WHERE no = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $no);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
