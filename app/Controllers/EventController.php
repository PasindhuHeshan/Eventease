<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Database;
use App\Models\UserModel;

class EventController
{
    private $eventModel;
    private $UserModel;

    public function __construct(Database $database)
    {
        $this->eventModel = new EventModel($database);
        $this->UserModel = new UserModel($database);
    }

    public function index()
    {
        $events = $this->eventModel->getAllEvents();
        $upevents = $this->eventModel->getAllupcomingEvents();
        include __DIR__ . '/../Views/events/index.php';
    }

    public function event()
    {
        $no = isset($_GET['no']) ? $_GET['no'] : null;
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null; 
        $isEnrolled = $this->eventModel->isUserEnrolled($username, $no);

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
