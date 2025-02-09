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
        $_SESSION['upevent'] = $upevents;
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
    public function getApprovedEvents() {
        $events = $this->eventModel->getApprovedEvents();
        include __DIR__ . '/../Views/events/staff.php';
    }

    public function acceptevent() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $no = $_POST['no'] ?? null;
    
            if ($no==null) {
                // Handle error: invalid event ID
                echo "Invalid event ID";
                exit();
            }
    
            if ($this->eventModel->acceptEvent($no)) {
                // Event approved successfully
                $events = $this->eventModel->getApprovedEvents();
                include __DIR__ . '/../Views/events/staff.php';
                exit();
            } else {
                // Handle error: failed to approve event
                echo "Error approving event";
            }
        }
    }
    
    public function rejectevent() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $no = $_POST['no'] ?? null;
            $reason = $_POST['reason'] ?? null;
    
            if ($no === null) {
                // Handle error: invalid event ID
                echo "Invalid event ID";
                exit();
            }
            if ($reason === null) {
                // Handle error: missing rejection reason
                echo "Missing rejection reason";
                exit();
            }
    
            if ($this->eventModel->rejectEvent($no, $reason)) {
                // Event rejected successfully
                $events = $this->eventModel->getApprovedEvents();
                include __DIR__ . '/../Views/events/staff.php';
                exit();
            } else {
                // Handle error: failed to reject event
                echo "Error rejecting event";
            }
        }
    }
    
    public function eventd()
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
            include __DIR__ . '/../Views/events/eventd.php';
        } else {
            echo "Event not found.";
        }
    }

    //write a fuction to insert contact us form data into the database
    public function contactus()
    {
        $type = isset($_POST['type']) ? $_POST['type'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : null;
        $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : null;

        if ($type === null || $email === null || $contact_no === null || $feedback === null) {
            echo "Error: Missing required fields";
            exit();
        }

        if ($this->eventModel->insertContactUs($type, $email, $contact_no, $feedback)) {
            include __DIR__ . '/../Views/events/contactus.php';
        } else {
            echo "Error submitting feedback";
        }
    }
    
}
?>
