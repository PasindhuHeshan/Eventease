<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Database;
use App\Models\UserModel;

class EventController
{
    private $eventModel;
    private $UserModel;
    private $username;

    public function __construct(Database $database)
    {
        $this->eventModel = new EventModel($database);
        $this->UserModel = new UserModel($database);
    }

    public function index()
    {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $events = $this->eventModel->getAllEvents();
        $upevents = $this->eventModel->getAllupcomingEvents($username);
        include __DIR__ . '/../Views/events/index.php';
    }

    public function event()
{
    $database = new Database();
    $no = isset($_GET['no']) ? $_GET['no'] : null;
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null; 

    $isEnrolled = false; // Default value when no user is logged in
    $userdata = ['usertype' => '']; // Default value when no user is logged in

    if ($username) {
        $isEnrolled = $this->eventModel->isUserEnrolled($username, $no);
        $userdata = $this->UserModel->getUserData($username, $database);
    }

    if ($event = $this->eventModel->getEvent($no)) {
        include __DIR__ . '/../Views/events/event.php';
    } else {
        echo "Event not found.";
    }
}



    public function eventenroll()
    { 
        session_start();
        if (!isset($_SESSION['username'])) { 
            header("Location: login.php"); 
            exit(); 
        } else { 
            $username = $_SESSION['username']; 
            $eventno = isset($_POST['event_no']) ? $_POST['event_no'] : null;

            if ($eventno === null) { 
                echo "Error: Event ID is missing.";
                exit(); 
            }

            if ($this->eventModel->addEnrollment($username, $eventno)) { 
                header("Location: event.php?no=" . $eventno); 
                exit(); 
            } else {
                echo "Error enrolling in event.";
            }
        }
    }

    public function removeEnrollment()
    {
        session_start();
        if (!isset($_SESSION['username'])) { 
            header("Location: login.php"); 
            exit(); 
        } else { 
            $username = $_SESSION['username']; 
            $eventno = isset($_POST['event_no']) ? $_POST['event_no'] : null;

            if ($eventno === null) { 
                echo "Error: Event ID is missing.";
                exit(); 
            }

            if ($this->eventModel->removeEnrollment($username, $eventno)) { 
                header("Location: event.php?no=" . $eventno); 
                exit(); 
            } else {
                echo "Error removing enrollment.";
            }
        }
    }
}
?>
