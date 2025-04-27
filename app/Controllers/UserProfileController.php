<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EventModel;
use App\Database;

class UserProfileController
{
    private $usermodel;

    public function __construct(Database $database)
    {
        $this->usermodel = new UserModel($database);
    }

    public function index()
    {
        $database = new Database();
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $userData = $this->usermodel->getUserData($username, $database);
        $roleData = $this->usermodel->getRoleRequest($database, $userData['No']);
        require __DIR__ . '/../Views/events/userprofile.php';
    }

    public function uploadProfilePicture()
    {
        $database = new Database();
        $userModel = new UserModel($database);
        
        $target_dir = "images/profiles/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;

        // ... other validation and security checks ...

        if ($uploadOk == 0) {
            // Handle upload errors
            // Redirect or display an error message
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $userModel->updateProfilePicture($_SESSION['username'], $target_file, $database);
                header("Location: userprofile.php");
                exit;
            } else {
                // Handle upload failures
                // Redirect or display an error message
            }
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $userModel = new UserModel($database);

            $username = $_SESSION['username'];
            $fname = $_POST['fname'] ?? null;
            $lname = $_POST['lname'] ?? null;
            $email = $_POST['email'] ?? null;
            $address = $_POST['address'] ?? null;
            $city = $_POST['city'] ?? null;
            $contactno1 = $_POST['contactno1'] ?? null;
            $contactno2 = $_POST['contactno2'] ?? null;
            $status = '1';

            if ($username && $fname && $lname && $email && $address && $city && $contactno1) {
                $isUpdated = $userModel->updateUserProfile(
                    $username,null, $fname, $lname, $email,null, $address, $city,$status, $database
                ) && $userModel->updateContactNumber($userModel->getUserData($username,$database)['No'], $contactno1, $contactno2, $database);

                if ($isUpdated) {
                    header("Location: userprofile.php");
                    exit;
                } else {
                    // Handle update failure
                    // Redirect or display an error message
                }
            } else {
                // Handle missing required fields
                // Redirect or display an error message
            }
        }
    }

    public function assignedevents(){
        require __DIR__ . '/../Views/EventSup/inquiry.php';
    }

    public function enrollstd() {
        $database = new Database();
        $eventModel = new EventModel($database);
        $username = $_SESSION['username'];
        $no = isset($_GET['no']) ? $_GET['no'] : null;
        $enrolled_people = $eventModel->getEnrolledPeople($no, $database);
        require __DIR__ . '/../Views/EventSup/enrollment.php';
    }
    public function report(){
        $database = new Database();
        $eventModel = new EventModel($database);
        $username = $_SESSION['username'];
        $no = isset($_GET['no']) ? $_GET['no'] : null;
        $event = $eventModel->getEventDetails($no);
        $managementStaff = $eventModel->getManagementStaff($no);
        $data = $eventModel->getEventStatistics($no);
        $org = $eventModel->getManagementOrg($no);
        $remarks = $eventModel->getEventRemarks($no);
        require __DIR__ . '/../Views/EventSup/report.php';
        
    }

    public function review(){
        require __DIR__ . '/../Views/EventSup/review.php';
    }

    public function stat(){
        $database = new Database();
        $eventModel = new EventModel($database);
        $username = $_SESSION['username']; 
        $no = isset($_GET['no']) ? $_GET['no'] : null;
        $data = $eventModel->getEventStatistics($no);
        require __DIR__ . '/../Views/EventSup/statistics.php';
    }

    public function inquiry(){
        $database = new Database();
        $userModel = new UserModel($database);
        $username = $_SESSION['username'];
        $no = isset($_GET['no']) ? $_GET['no'] : null;
        $eventreviews = $userModel->getreviews($no,$database);
        require __DIR__ . '/../Views/EventSup/inquiry.php';
    }
    public function deleteAccount()
    {
        $database = new Database();
        $userModel = new UserModel($database);
        $username = $_SESSION['username'];
        $userModel->deleteUser($username, $database);
        session_unset();
        session_destroy();
        header("Location: deletetoindex");
    }

}
