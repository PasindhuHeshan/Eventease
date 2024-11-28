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
        $roleData = $this->usermodel->getRoleRequest($database, $username);
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

            if ($username && $fname && $lname && $email && $address && $city && $contactno1) {
                $isUpdated = $userModel->updateUserProfile(
                    $username, $fname, $lname, $email, $address, $city, $contactno1, $contactno2, $database
                );

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
}
