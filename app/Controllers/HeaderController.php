<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Event;
use App\Database;

class HeaderController {
    private $usermodel;
    private $eventmodel;

    public function __construct() {
        $database = new Database();
        $conn = $database->getConnection();
        $this->usermodel = new UserModel($conn);
        $this->eventmodel = new Event($conn);
    }

    public function render() {
        $database = new Database();
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
        $profilePicture = './images/profiles/adminlogo.png'; // Default profile picture path
        $events = [];
        $fname = ''; // Initialize $fname to avoid undefined variable warning
        if ($username !== 'Guest') {
            $userData = $this->usermodel->getUserData($username, $database);
            if ($userData && $userData['profile_picture']) {
                $profilePicture = $userData['profile_picture'];
                $fname = $userData['fname']; // Set $fname from user data
                $events = $this->eventmodel->getUpcomingEvents($username);
            }
        }
        require __DIR__ . '/../Views/events/header.php';
    }

    public function checkUser($username) {
        $database = new Database();
        return $this->usermodel->checkUser2($username, $database);
    }

    public function processRegistration() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            if ($this->checkUser($username)) {
                echo "<div class='error'>Username already exists.</div>";
                return;
            }
    
            // Proceed with the rest of the form processing
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $contactno1 = $_POST['contactno1'];
            $contactno2 = $_POST['contactno2'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $status = $_POST['status'];
    
            // Define usertype, universityid, universityregno, and profile_picture
            $usertype = isset($_POST['usertype']) ? $_POST['usertype'] : 'guest';
            $universityid = isset($_POST['universityid']) ? $_POST['universityid'] : '0';
            $universityregno = isset($_POST['universityregno']) ? $_POST['universityregno'] : '0';
            $profile_picture = isset($_POST['profile_picture']) ? $_POST['profile_picture'] : null;
    
            // Ensure universityid and universityregno are set to '0' for guests
            if ($usertype === 'guest') {
                $universityid = '0';
                $universityregno = '0';
            }
    
            // Insert the new user into the database
            $this->usermodel->createUser(
                $username, $password, $fname, $lname, $email, 
                $usertype, $universityid, $universityregno, $address, $city,
                $contactno1, $contactno2, $profile_picture,$status, 
                new Database()
            );
        }
    }
    

}
?>
