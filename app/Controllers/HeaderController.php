<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Event;
use App\Models\notifications;
use App\Database;

class HeaderController {
    private $usermodel;
    private $eventmodel;
    private $notifications;

    public function __construct() {
        $database = new Database();
        $conn = $database->getConnection();
        $this->usermodel = new UserModel($conn);
        $this->eventmodel = new Event($conn);
        $this->notifications = new notifications($conn);
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
            $checknewchat = $this->notifications->checknewchat($userData['email'], $database);  //for user
            $checknewchatadmin = $this->notifications->checknewchatforadmin($database);  //for admin
            if ($checknewchat) {
                $newchat = true;
            } else {
                $newchat = false;
            }

            if ($checknewchatadmin) {
                $newchatadmin = true;
            } else {
                $newchatadmin = false;
            }
        }
        require __DIR__ . '/../Views/events/header.php';
    }

    public function checkUser($username) {
        $database = new Database();
        return $this->usermodel->checkUser2($username, $database);
    }
    

}
?>
