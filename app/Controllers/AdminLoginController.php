<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Dashboard;
use App\Database;

require_once __DIR__ . '/../Models/Dashboard.php';

class AdminLoginController {
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['name'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($username && $password) {
                $database = new Database(); // Ensure the database connection is created here
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

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }

    public function dashboard() {
        $database = new Database();
        $dashboard = new Dashboard($database);

        $user_count = $dashboard->getUserCount('user_type');
        $event_count = $dashboard->getEventCount('event_type');
        $inventory_count = $dashboard->getInventoryCount('inventory_type');

        include __DIR__ . '/../Views/events/dashboard_content.php';
    }
}
?>
