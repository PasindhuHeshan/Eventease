<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Database;

class UserProfileController{

    private $user;
    private $username;
    private $usermodel;

    public function __construct(Database $database)
    {
        $this->usermodel = new UserModel($database);
    }

    public function index() {
        $database = new Database();
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $userData = $this->usermodel->getUserData($username,$database);
        require __DIR__ . '/../Views/events/userprofile.php';
    }
}