<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EventModel;
use App\Models\Dashboard;
use App\Models\Contactus;
use App\Models\EmailModel;
use App\Database;
use App\Controllers\UserProfileController;

class AdminLoginController {
    private $userModel; 
    private $emailModel; 
    
    public function processSendEmail() {
        $purpose = $_POST['purpose'] ?? null;

        if (isset($_POST['send_email'])) {
            $recipient_string = $_POST['recipient_email'] ?? null;
            $emailbody = $_POST['email_body'];
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            // $row_id = $_POST['row_id'];

            $body = "Dear " . htmlspecialchars($name) . ",<br><br>" .
                    htmlspecialchars($emailbody) . "<br><br>" .
                    "Best regards,<br>" .
                    "The EventEase Team";
            $body = nl2br(htmlspecialchars($body)); // Corrected nl2br placement

            if($purpose == "03"){
                $this->emailModel = new EmailModel();
                $recipients_array = array_map(function($email) {
                    $trimmed_email = trim($email);
                    if (str_starts_with($trimmed_email, '(') && str_ends_with($trimmed_email, ')')) {
                        return substr($trimmed_email, 1, -1);
                    }
                    return $trimmed_email;
                }, explode(',', $recipient_string));

                $success = $this->emailModel->sendBulkEmail($recipients_array, $subject, $body);
                $recipient_display = htmlspecialchars($recipient_string);
            } else {
                $this->emailModel = new EmailModel();
                $success = $this->emailModel->sendEmail($recipient_string, $subject, $body);
                $recipient_display = htmlspecialchars($recipient_string);
            }

            if ($success[0]) {
                $_SESSION['email_message'] = "Email sent successfully to " . $recipient_display;
                $_SESSION['email_success'] = true;
            } else {
                $_SESSION['email_message'] = "Error sending email to " . $recipient_display . ": " . $this->emailModel->getErrorInfo();
                $_SESSION['email_success'] = false;
            }

            if($purpose == null){
                // $userModel = new UserModel();
                // $database = new Database();
                // $userModel->changedisableaccstatus($row_id,$database);
            } else if($purpose == "01"){
                $database = new Database();
                $eventModel = new EventModel($database);
                $row_id = $_POST['inq_no'] ?? null;
                $event_no = $_POST['event_no'] ?? null;
                $eventModel->changeinquiryStatus($row_id,$database);
                $upcontroller = new UserProfileController($database);
                header('Location: inquiry?no=' . $event_no);
                exit();
            } else if($purpose == "02"){
                $database = new Database();
                $eventModel = new EventModel($database);
                $rev_id = $_POST['rev_no'] ?? null;
                $event_no = $_POST['event_no'] ?? null;
                $eventModel->changereviewStatus($rev_id,$database);
                $upcontroller = new UserProfileController($database);
                header('Location: review?no=' . $event_no);
                exit();
            } else if($purpose == "03"){
                $event_no = $_POST['event_no'] ?? null;
                header('Location: addmore?no=' . $event_no);
                exit();
            } else {
                header('Location: index.php?url=feedback.php');
                exit();
            }

            header('Location: index.php?url=disableacc.php'); // Redirect back to manage users page
            exit();
        } else {
            // Handle cases where the form wasn't submitted correctly
            header('Location: index.php?url=disableacc.php'); // Redirect back
            exit();
        }
    }

    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['name'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($username && $password) {
                $database = new Database(); 
                $userModel = new UserModel();
                $isValidUser = $userModel->validateUser($username, $password, $database);

                if ($isValidUser) {
                    $_SESSION['username'] = $username;
                    header("Location: ../public/index.php?url=dashboard.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Incorrect Username or Password!';
                    header("Location: ../public/index.php?url=adminlogin.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Please enter both username and password!';
                header("Location: ../public/index.php?url=adminlogin.php");
                exit();
            }
        } else {
            $this->form();
        }
    }

    public function form() {
        $error = $_SESSION['error'] ?? null;
        include __DIR__ . '/../Views/events/adminlogin.php';
    }

    public function logout(){
        //session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    public function dashboard() {
        $database = new Database();
        $dashboard = new Dashboard($database);
        $usermodel = new UserModel();
        $eventmodel = new EventModel($database);
        $no=null;

        $eventcount = $eventmodel->getNotApprovedEventsforadmin($database);
        $roleRequestscount = count($usermodel->getRoleRequests($database));
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        
        $user_types = $dashboard->getuserdatausingtypes();
        $new_users = $dashboard->getNewUsersByType();
        $user_count = $dashboard->getUserCount('user_type');
        $newuser_count = $dashboard->getNewUsersByType();
        $event_count = $dashboard->getEventCount('event_type');
        $disableacccount = count($usermodel->getdisableaccComplaints($database));
        $feedbackcount = count($usermodel->getnormalfeedbacks($database)) + count($usermodel->getregfeedbacks($database));

        include __DIR__ . '/../Views/events/dashboard_content.php';
    }

    public function manageusers(){
        $database = new Database();
        $dashboard = new Dashboard($database);
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);

        $result = $dashboard->getUsers();
        include __DIR__ . '/../Views/events/manage_users.php';
    }

    public function role_requests() {
        $database = new Database();
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['no'])) {
            $no = $_POST['no'];
            $reply = $_POST['reply'] ?? '';
            $orgno = $_POST['orgno'] ?? null;

            if (isset($_POST['approve'])) {
                $new_role = 'approved';
            } else {
                $new_role = 'rejected';
            }

            if ($usermodel->admin_updateRoleRequests($no,$orgno, $new_role, $reply, $database)) {
                $_SESSION['success'] = 'Role request updated successfully!';
            } else {
                $_SESSION['error'] = 'Error updating role request!';
            }
        }

        $roleRequests = $usermodel->getRoleRequests($database);
        include __DIR__ . '/../Views/events/role_requests.php';
    }


    public function useradd() {
        $database = new Database();
        $userModel = new UserModel();
        $emailModel = new EmailModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userModel->getUserDatabyemail($_POST['email'], $database)==null) {
            $username = $_POST['email'];
            $email = $_POST['email'];
            $usertype = 5;
            $defaultPassword = $this->generateDefaultPassword();

            // Basic validation
            if (empty($email) || empty($usertype)) {
                $_SESSION['error'] = "All fields are required.";
                $_SESSION['ac_createerror'] = true;
                header('Location: index.php?url=manage_users.php');
                exit();
            }

            $hashedPassword = password_hash($defaultPassword, PASSWORD_BCRYPT);
            $fname = null;
            $lname = null;
            $id = null;
            $address = null;
            $city = null;
            $profile_picture = null;
            $status = 0;
            $database = new Database();

            if ($userModel->createUser(
                $username, $hashedPassword, $fname, $lname, $email, 
                $usertype, $id, $address, $city, $profile_picture, $status, $database
            )) {
                // Send the welcome email
                $subject = 'Your Eventease Account Created';
                $body = "Dear User,\r\n\r\n" .
                        "Your account on Eventease has been created.\r\n" .
                        "You can log in using the following credentials:\r\n" .
                        "Email: " . htmlspecialchars($email) . "\r\n" .
                        "Password: " . htmlspecialchars($defaultPassword) . "\r\n\r\n" .
                        "We recommend you change your password after your first login.\r\n\r\n" .
                        "Welcome to Eventease!\r\n";

                $body = nl2br($body); // Convert line breaks to HTML <br> tags

                $emailSent = $emailModel->sendEmail($email, $subject, $body);

                if ($emailSent[0]) {
                    $_SESSION['message'] = "Staff member created and welcome email sent to " . htmlspecialchars($email);
                } else {
                    $_SESSION['message'] = "Staff member created, but failed to send welcome email. Error: " . $emailSent[1];
                }
                header('Location: index.php?url=manage_users.php');
                exit();
            } else {
                $_SESSION['error'] = "Error creating user.";
                $_SESSION['ac_createerror'] = true;
                header('Location: index.php?url=manage_users.php');
                exit();
            }
        }else{
            $_SESSION['error'] = "Email already exists.";
            $_SESSION['ac_createerror'] = true;
            header('Location: index.php?url=manage_users.php');
            exit();
        }
    }

    private function generateDefaultPassword($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+[]{}|;:,.<>?';
        $password = '';
        $characterCount = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $characterCount - 1)];
        }
        return $password;
    }

    public function changestatus() {
        $database = new Database();
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['No']) && isset($_POST['status'])) {
            $No = $_POST['No'];
            $status = $_POST['status'];
            $database = new Database();
            $dashboard = new Dashboard($database);

            if ($dashboard->updateStatus($No, $status)) {
                $_SESSION['success'] = 'Status updated successfully!';
                include __DIR__ . '/../Views/events/manage_users.php';
                exit();
            } else {
                $_SESSION['error'] = 'Error updating status!';
                include __DIR__ . '/../Views/events/manage_users.php';
                exit();
            }
        } else {
            $_SESSION['error'] = 'Invalid request!';
            include __DIR__ . '/../Views/events/manage_users.php';
            exit();
        }
    }
    

    public function manageevent(){
        $database = new Database();
        $eventmodel = new EventModel($database);
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        $events = $eventmodel->getadmineventinventory($database);
        $eventtype = $eventmodel->geteventtypes($database);

        include __DIR__ . '/../Views/events/manageevent.php';
    }

   

    public function events(){
        include __DIR__ . '/../Views/events/events.php';
    }


    public function Inventory() {

        $database = new Database();
        $dashboard = new Dashboard($database);
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);

        // Check if 'inventory_type' is set, otherwise default to 'Appliances'
        $inventory_type = isset($_POST['inventory_type']) ? $_POST['inventory_type'] : 'Appliances';

        // Fetch inventory data
        $result = $dashboard->getInventoryByType($inventory_type);

        // Include the view file
        include __DIR__ . '/../Views/events/inventory.php';
    }

    public function add_item(){
        include __DIR__ . '/../views/events/add_item.php';
    }

    public function save_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $item = $_POST['item'] ?? null;
            $inventory_no = $_POST['inventory_no'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $inventory_type = $_POST['inventory_type'] ?? null;

            $database = new Database();
            $dashboard = new Dashboard($database);

            if($dashboard->check_item($inventory_no)){
                $_SESSION['error'] = $inventory_no." Inventory Number already exists!";
                include __DIR__ . '/../views/events/add_item.php';
                exit();
            }

            if ($dashboard->save_item($item, $inventory_no, $quantity, $inventory_type)) {
                include __DIR__ . '/../views/events/inventory.php';
            } else {
                echo "Not added.";
            }
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['back'])){
            $item = $_POST['item'] ?? null;
            $inventory_no = $_POST['inventory_no'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $inventory_type = $_POST['inventory_type'] ?? null;

            $database = new Database();
            $dashboard = new Dashboard($database);
            
            include __DIR__ . '/../views/events/inventory.php';
        }
    }

    public function delete_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inventory_no']) && isset($_POST['inventory_type'])) {
            $inventory_no = $_POST['inventory_no'];
            $inventory_type = $_POST['inventory_type'] ?? 'Appliances';
            $database = new Database();
            $dashboard = new Dashboard($database);
            
            if($dashboard->delete_item($inventory_no)){
                //header("Location: inventory.php");
                include __DIR__ . '/../views/events/inventory.php';
                exit();
            }else{
                //echo "Item is in use. Cannot delete.";
                $_SESSION['delete_error'] = "Item Cannot Delete!";
                    //header("Location: ../public/index.php?url=login.php")
                include __DIR__ . '/../views/events/inventory.php';
                exit();
            }
        }
    }
   
   
    
    public function modify_item() {
        $database = new Database();
        $dashboard = new Dashboard($database);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle POST data here
            $inventoryNo = $_POST['inventory_no'] ?? null;
            $item = $_POST['item'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $inventoryType = $_POST['inventory_type'] ?? null;
            
            if($quantity >= $_POST['in_use']){
                if ($inventoryNo && $item && $quantity && $inventoryType) {
                    try {
                        if ($dashboard->modify_item($inventoryNo, $item, $quantity, $inventoryType)) {
                            
                            include __DIR__ . '/../views/events/inventory.php';
                            exit();
                        } else {
                            echo "Error modifying item.";
                        }
                    } catch (Exception $e) {
                        echo "An error occurred: " . $e->getMessage();
                    }
                } else {
                    echo "Missing data for modification.";
                }
            }else{
                $_SESSION['error'] = "Enter the Modified Quantity below the available Quantity";
                $itemData = $dashboard->getItemByInventoryNo($inventoryNo);
                include __DIR__ . '/../views/events/modify_item.php';
            }
        } else {
            // Check if inventory_no is provided via GET
            $inventoryNo = $_GET['inventory_no'] ?? null;
    
            if ($inventoryNo) {
                $itemData = $dashboard->getItemByInventoryNo($inventoryNo);
    
                if ($itemData) {
                    // Pass item data to the view
                    include __DIR__ . '/../views/events/modify_item.php';
                } else {
                    echo "Item not found.";
                }
            } else {
                echo "Inventory number is missing.";
            }
        }
    }
    

    public function get_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $database = new Database();
            $dashboard = new Dashboard($database);
    
            if ($id) {
                $itemData = $dashboard->getItemByInventoryNo($id);
    
                if ($itemData) {
                    // Redirect to the edit item view, passing the item data
                    $_SESSION['itemData'] = $itemData;
                    include __DIR__ . '/../Views/events/modify_item.php';
                    exit;
                } else {
                    echo "Item not found.";
                }
            } else {
                echo "Inventory number is missing.";
            }
        }
    }
    
    public function importExcel()
    {
        if (isset($_POST['import'])) {
            // Check if a file is uploaded
            if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
                $file = $_FILES['excel_file']['tmp_name'];
                $this->processExcel($file);
            } else {
                $_SESSION['error'] = 'Please upload a valid Excel file.';
            }
        }
        $database = new Database();
        $dashboard = new Dashboard($database);
        include __DIR__ . '/../views/events/inventory.php';
    }

    private function processExcel($file)
    {
        require_once __DIR__ . '/../../../vendor/autoload.php';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();

        $rows = $worksheet->toArray();
        array_shift($rows); // Remove the first row (header)

        foreach ($rows as $row) {
            $item = $row[1];
            $inventory_no = $row[2];
            $quantity = $row[3];
            $inventory_type = $row[4];

            // Insert data into the database
            $dashboard = new Dashboard(new Database());
            $dashboard->insertItem($item, $inventory_no, $quantity, $inventory_type);
        }
    }

    public function disableacc(){
        $database = new Database();
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        $complaints = $usermodel->getdisableaccComplaints($database);
        include __DIR__ . '/../Views/events/disableacc.php';
    }

    public function activeacc(){
        $database = new Database();
        $dashboard = new Dashboard($database);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $no = $_POST['no'] ?? null;
            $dashboard->updateStatus($no,1);
            $usermodel = new UserModel();
            $adminData = $usermodel->getUserData($_SESSION['username'], $database);
            $usermodel->deleteComplaint($no, $database);
            $_SESSION['success'] = 'Complaint deleted successfully!';
            $this->disableacc();
        }
    }

    public function getfeedbacks(){
        $database = new Database();
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        $complaints = $usermodel->getnormalfeedbacks($database);
        $regcomplaints = $usermodel->getregfeedbacks($database);
        include __DIR__ . '/../Views/events/feedback.php';
    }

    public function feedbackdone(){
        $database = new Database();
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row_id = $_POST['row_id'] ?? null;
            $usermodel->feedbackdone($row_id, $database);
            $_SESSION['success'] = 'Complaint deleted successfully!';
            $complaints = $usermodel->getnormalfeedbacks($database);
            $regcomplaints = $usermodel->getregfeedbacks($database);
            include __DIR__ . '/../Views/events/feedback.php';
        }
    }

    public function replyfeedback(){
        $database = new Database();
        $contactus = new Contactus();
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $row_no = $_POST['row_no'] ?? null;
            $reply = $_POST['reply'] ?? null;
            $contactus->replyfeedback($row_no, $reply, $database);
            $_SESSION['success'] = 'Reply sent successfully!';
            $complaints = $usermodel->getfeedbacks($database);
            include __DIR__ . '/../Views/events/feedback.php';
        }
    }

    public function adminviewevent(){
        $database = new Database();
        $eventmodel = new EventModel($database);
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);
        $event_id = $_POST['event_id'] ?? null;
        $inventory_item = $_POST['inventory_item'] ?? null;
        $event = $eventmodel->getoneeventinventory($event_id,$inventory_item, $database);
        $eventstart = $event['time'];
        $eventend = $event['finish_time'];
        $eventdate = $event['date'];
        $availability = $eventmodel->getavailability($inventory_item,$eventstart,$eventend,$eventdate, $database);
        include __DIR__ . '/../Views/events/viewevent.php';
    }

    public function handleinventory(){
        $database = new Database();
        $eventmodel = new EventModel($database);
        $usermodel = new UserModel();
        $adminData = $usermodel->getUserData($_SESSION['username'], $database);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])){
            $event_id = $_POST['event_id'] ?? null;
            $inventory_item = $_POST['inventory_item'] ?? null;
            $eventmodel->approveinventory($event_id,$inventory_item, $database);
            header("Location: manageevent.php");
            exit();
        }else{
            $event_id = $_POST['event_id'] ?? null;
            $inventory_item = $_POST['inventory_item'] ?? null;
            $eventmodel->rejectinventory($event_id,$inventory_item, $database);
            header("Location: manageevent.php");
            exit();
        }
    }

    // public function rejectcomplaint(){
    //     $database = new Database();
    //     $usermodel = new UserModel();
    //     $adminData = $usermodel->getUserData($_SESSION['username'], $database);

    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         $row_id = $_POST['row_id'] ?? null;
    //         $usermodel->deleterejectComplaint($row_id, $database);
    //         $this->disableacc();
    //     }
    // }
}