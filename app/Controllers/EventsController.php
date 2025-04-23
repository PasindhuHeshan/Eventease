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
        $events = $this->eventModel->getEventsByStaff($userData['No']);
        
        include __DIR__ . '/../Views/EventOrg/myevents.php';
    }

    public function addmore() {
        $eventno = isset($_GET['no']) ? htmlspecialchars($_GET['no']) : null;
        $eventData = null;
        $userData = $this->userModel->getUserData($_SESSION['username'], new Database());

        $staffMembers = $this->eventModel->getStaffMembers();
        $geteventstaffmembers = $this->eventModel->getEventStaffMembers($eventno);
        $eventData = $this->eventModel->getEvent($eventno);
        $eventsinventory = $this->eventModel->geteventsinventory($eventData['date'], $eventData['finish_time'], $eventData['date'], new Database());
        $getthiseventinventory = $this->eventModel->getInventoryRequested($eventno);

        // Pass both variables to the view
        include __DIR__ . '/../Views/EventOrg/edit.php';
    }

    public function createform() {
        $eventno = isset($_GET['no']) ? htmlspecialchars($_GET['no']) : null;
        $eventData = null;

        $supervisors = $this->eventModel->getsupervisors();
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
        $userData = $this->userModel->getUserData($username, $database);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input data (optional but recommended)
            // ... (implement validation logic based on your requirements)

            $name = $_POST['name'];
            $short_dis = null;
            $long_dis = $_POST['long_dis'];
            $flag = (int)$_POST['flag'];
            $time = $_POST['time'];
            $finish_time = $_POST['finish_time'];
            $date = $_POST['date'];
            $location = $_POST['location'];
            $people_limit = (int)$_POST['people_limit'];
            $event_type = $_POST['event_type'];
            $approvedstatus = 1;
            $supervisor = $_POST['supervisor'];
            $organizer = $userData['No'];
            $organization_no = $userData['organization_no'];

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
                            $name, $short_dis, $long_dis, $flag, $time, $finish_time, $date, $location,
                            $people_limit, $event_type, $approvedstatus, $supervisor, $target_file, $organizer, $organization_no
                        );

                        if ($result) {
                            echo "Event created successfully!";
                            $this->index();
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


    public function updateEvent(
        $eventno, $name, $short_dis, $long_dis, $flag, $time, $date, $location,
        $people_limit, $event_type, $approvedstatus, $supervisor, $event_banner, $organizer
    ) {
        $sql = "UPDATE events SET 
                name = ?, 
                short_dis = ?, 
                long_dis = ?, 
                flag = ?, 
                time = ?, 
                date = ?, 
                location = ?, 
                people_limit = ?, 
                event_type = ?, 
                approvedstatus = ?, 
                supervisor = ?, 
                event_banner = ?, 
                organizer = ? 
                WHERE no = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssi", 
            $name, $short_dis, $long_dis, $flag, $time, $date, 
            $location, $people_limit, $event_type, $approvedstatus, 
            $supervisor, $event_banner, $organizer, $eventno
        );
         
        return $stmt->execute();
    }
    
    /**
    * Update staff assignments for an event
    */
    public function updateEventStaff($eventno, $staffUpdates) {
        // First, clear existing staff for this event
        $this->conn->query("DELETE FROM event_staff WHERE eventno = $eventno");
        
        // Then insert the new staff assignments
        foreach ($staffUpdates as $staffId => $role) {
            $sql = "INSERT INTO event_staff (eventno, staffno, role) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iis", $eventno, $staffId, $role);
            $stmt->execute();
        }
            
        return true;
    }
    
    /**
    * Create a new notification
    */
    public function createNotification($eventno, $title, $description, $receivers) {
        $sql = "INSERT INTO notifications 
                (eventno, title, description, receivers, created_at) 
                VALUES (?, ?, ?, ?, NOW())";
          
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isss", $eventno, $title, $description, $receivers);
            
        return $stmt->execute();
    }
    
    /**
     * Create an inventory request
     */
    
 
    public function processEvent() {
        $database = new Database();
        $username = $_SESSION['username'];
        $userData = $this->userModel->getUserData($username, $database);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventno = $_POST['eventno'] ?? null;

            if (isset($_POST['update_details'])) {
                // Handle general details update
                $name = $_POST['name'];
                $short_dis = $_POST['short_dis'] ?? ''; // Ensure $short_dis is defined
                $long_dis = $_POST['long_dis'];
                $flag = (int)$_POST['flag'];
                $time = $_POST['time'];
                $finish_time = $_POST['finish_time'] ?? null;
                $date = $_POST['date'];
                $location = $_POST['location'];
                $people_limit = (int)$_POST['people_limit'];
                $event_type = $_POST['event_type'];
                $supervisor = $_POST['supervisor'] ?? null;
                $organizer = $userData['No'];

                // Handle file upload
                $event_banner = $_POST['existing_event_banner'] ?? null;
                if (isset($_FILES['event_banner']) && $_FILES['event_banner']['error'] == 0) {
                    $target_dir = "images/events/";
                    $target_file = $target_dir . basename($_FILES["event_banner"]["name"]);
                    if (move_uploaded_file($_FILES["event_banner"]["tmp_name"], $target_file)) {
                        $event_banner = $target_file;
                    }
                }

                $this->eventModel->updateEvent(
                    $eventno, $name, $short_dis, $long_dis, $flag, $time, $finish_time, $date, $location,
                    $people_limit, $event_type, 1, $supervisor, $event_banner, $organizer
                );
            } elseif (isset($_POST['update_staff'])) {
                // Handle staff updates
                $staffUpdates = [];
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'role_') === 0) {
                        $index = substr($key, 5);
                        $staffId = $_POST['staff_id_' . $index] ?? null;
                        if ($staffId) {
                            $staffUpdates[$staffId] = $value;
                        }
                    }
                }
                $this->updateEventStaff($eventno, $staffUpdates);
            } elseif (isset($_POST['send_notification'])) {
                // Handle notification
                $title = $_POST['notification_title'];
                $description = $_POST['notification_description'];
                $receivers = $_POST['notification_receivers'];

                $this->createNotification(
                    $eventno, $title, $description, $receivers
                );
            } elseif (isset($_POST['request_inventory'])) {
                // Handle inventory request
                $inventoryRequests = [];
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'inventory_item_') === 0) {
                        $index = substr($key, strlen('inventory_item_'));
                        $quantity = (int)($_POST['inventory_quantity_' . $index] ?? 0);
                        $itemId = $_POST['inventory_id_' . $index] ?? null;
            
                        if (!empty($value) && $quantity > 0) {
                            $inventoryRequests[] = [
                                'item' => $value,
                                'quantity' => $quantity,
                                'id' => $itemId
                            ];
                        }
                    }
                }
            
                foreach ($inventoryRequests as $request) {
                    $id = $this->eventModel->getInventorybyitem($request['item']);
                    $this->eventModel->insertInventoryRequest(
                        $eventno,
                        $id,
                        $request['quantity']
                    );
                }
            }
            

            // Redirect back to the edit page after processing
            header("Location: addmore?no=" . $eventno);
            exit();
            
        }

        // If not a POST request, show the form
        $eventno = $_GET['no'] ?? null;
        if ($eventno) {
            $eventData = $this->eventModel->getEvent($eventno);
            $staffMembers = $this->eventModel->getStaffMembers();
            include __DIR__ . '/../Views/EventOrg/edit.php';
        } else {
            // Handle error
            header("Location: myevents");
            exit();
        }
    }
}