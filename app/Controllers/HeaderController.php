<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Event;
use App\Database;

class HeaderController {
    private $usermodel;
    private $eventmodel;

    public function render() {
        $database = new Database();
        $conn = $database->getConnection();
        $this->usermodel = new UserModel($conn);
        $this->eventmodel = new Event($conn);
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
        $profilePicture = './images/profiles/adminlogo.png'; // Default profile picture path
        $events = [];
        $fname = '';
        if ($username !== 'Guest') {
            $userData = $this->usermodel->getUserData($username, $database);
            if ($userData && $userData['profile_picture']) {
                $profilePicture = $userData['profile_picture'];
                $fname = $userData['fname'];
                $events = $this->eventmodel->getUpcomingEvents($username);
            }
        }
        require __DIR__ . '/../Views/events/header.php';
    }
}
?>
