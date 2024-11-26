<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Database;

class HeaderController {
    private $usermodel;

    public function render() {
        $database = new Database();
        $this->usermodel = new UserModel($database);
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
        $profilePicture = './images/profiles/adminlogo.png'; // Default profile picture path
        if ($username !== 'Guest') {
            $userData = $this->usermodel->getUserData($username,$database);
            if ($userData && $userData['profile_picture']) {
                $profilePicture = $userData['profile_picture'];
                $fname = $userData['fname'];
            }
        }
        require __DIR__ . '/../Views/events/header.php';
    }
}
?>
