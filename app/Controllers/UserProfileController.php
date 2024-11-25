<?php

namespace App\Controllers;

use App\Models\UserModel;
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
        require __DIR__ . '/../Views/events/userprofile.php';
    }

    public function uploadProfilePicture()
    {
        $database = new Database(); // Instantiate the database connection
        $userModel = new UserModel($database); // Pass the database object to UserModel
        // Security checks and validation
        $target_dir = "images/profiles/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        // ... other validation and security checks ...

        if ($uploadOk == 0) {
            // Handle upload errors
            // Redirect or display an error message
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                // Update the user's profile picture path in the database
                $userModel->updateProfilePicture($_SESSION['username'], $target_file, $database);
                // Redirect to the profile page or display a success message
                header("Location: userprofile.php");
                exit;
            } else {
                // Handle upload failures
                // Redirect or display an error message
            }
        }
    }
}
