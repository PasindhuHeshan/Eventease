<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Database;
use App\Models\UserModel;

class EventsController {
    private $eventModel;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->eventModel = new EventModel($database);
        $this->userModel = new UserModel($database); // Initialize UserModel
    }

    public function index() {
        $database = new Database();
        $username = $_SESSION['username'];
        $userData = $this->userModel->getUserData($username,$database);
        $events = $this->eventModel->getEventsByOrganizer($userData['No']);
        
        include __DIR__ . '/../Views/EventOrg/myevents.php';
    }

    public function addmore() {
        include __DIR__ . '/../Views/EventOrg/edit.php';
    }


    public function createform() {
        $eventno = isset($_GET['no']) ? htmlspecialchars($_GET['no']) : null;
        $eventData = null;

        if ($eventno) {
            $eventData = $this->eventModel->getEvent($eventno);
            // Check if event was found
            if (!$eventData) {
                // Handle error, e.g., display an error message or redirect to an error page
                header("Location: /error_page.php?message=Event not found");
                exit;
            }
        }

        include __DIR__ . '/../Views/EventOrg/create.php';
    }

    public function createEvent() {

        $database = new Database();
        $username = $_SESSION['username'];
        $userData = $this->userModel->getUserData($username,$database);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input data (optional but recommended)
            // ... (implement validation logic based on your requirements)

            $name = $_POST['name'];
            $short_dis = $_POST['short_dis'];
            $long_dis = $_POST['long_dis'];
            $flag = (int)$_POST['flag'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $location = $_POST['location'];
            $people_limit = (int)$_POST['people_limit'];
            $event_type = $_POST['event_type'];
            $approvedstatus = 1; // Set initial approval status as pending
            $supervisor = $_POST['supervisor'];
            $organizer = $_POST['organizer'];

            // Handle file upload
            if (isset($_FILES['event_banner']) && $_FILES['event_banner']['error'] == 0) {
                $target_dir = "images/events/";
                $target_file = $target_dir . basename($_FILES["event_banner"]["name"]);
                $uploadOk = 1;

                // Check if file is an actual image
                $check = getimagesize($_FILES["event_banner"]["tmp_name"]);
                if ($check === false) {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Allow specific file formats
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["event_banner"]["tmp_name"], $target_file)) {
                        $result = $this->eventModel->createEvent(
                            $name, $short_dis, $long_dis, $flag, $time, $date, $location,
                            $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer
                        );

                        if ($result) {
                            echo "Event created successfully!";
                            $events = $this->eventModel->getEventsByOrganizer($username);
                            include __DIR__ . '/../Views/EventOrg/myevents.php';
                        } else {
                            echo "Error creating event: " . $this->eventModel->conn->error;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                
            } else {
                // Handle the case where no file is uploaded or there's an error
                echo "No file was uploaded or there was an error uploading the file.";
                // You might want to handle this case differently, e.g., by creating the event without an image or redirecting the user to an error page.
            }
        } else {
            include __DIR__ . '/../Views/EventOrg/create.php';
        }
    }

    public function processEvent() {
        $database = new Database();
        $username = $_SESSION['username'];
        $userData = $this->userModel->getUserData($username,$database);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $eventno = $_POST['eventno'];
            $name = $_POST['name'];
            $short_dis = $_POST['short_dis'];
            $long_dis = $_POST['long_dis'];
            $flag = (int)$_POST['flag'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $location = $_POST['location'];
            $people_limit = (int)$_POST['people_limit'];
            $event_type = $_POST['event_type'];
            $approvedstatus = 1;
            $supervisor = $_POST['supervisor'];
            $organizer = $_POST['organizer'];
            $database = new Database(); // Ensure the database connection is created here
    
            // Handle file upload
            if (isset($_FILES['event_banner']) && $_FILES['event_banner']['error'] == 0) {
                $target_dir = "images/events/";
                $target_file = $target_dir . basename($_FILES["event_banner"]["name"]);
                $uploadOk = 1;
    
                // Check if file is an actual image
                $check = getimagesize($_FILES["event_banner"]["tmp_name"]);
                if ($check === false) {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
    
                // Allow specific file formats
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
    
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["event_banner"]["tmp_name"], $target_file)) {
                        $event_banner = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                // Use existing event banner if no new file is uploaded
                $event_banner = isset($_POST['existing_event_banner']) ? $_POST['existing_event_banner'] : null;
            }
    
            $this->eventModel->updateEvent($eventno, $name, $short_dis, $long_dis, $flag, $time, $date, $location, $people_limit, $event_type, $approvedstatus, $supervisor, $event_banner, $organizer); 
            $events = $this->eventModel->getEventsByOrganizer($username);
            include __DIR__ . '/../Views/EventOrg/myevents.php';
            exit();    
                
        } else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])){
            $eventno = $_POST['eventno'];
            $database = new Database();
            $this->eventModel->deleteEvent($eventno, $database);
            $events = $this->eventModel->getEventsByOrganizer($username);
            include __DIR__ . '/../Views/EventOrg/myevents.php';
            exit();
        } else {
            // Redirect or load the form again
            include __DIR__ . '/../Views/EventOrg/edit.php';
        }
    }
}