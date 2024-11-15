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

    public function logout(){
        //session_start();
        session_destroy();
        header("Location: adminlogin.php");
        exit();
    }

    public function dashboard() {
        $database = new Database();
        $dashboard = new Dashboard($database);

        $user_count = $dashboard->getUserCount('user_type');
        $event_count = $dashboard->getEventCount('event_type');
        $inventory_count = $dashboard->getInventoryCount('inventory_type');

        include __DIR__ . '/../Views/events/dashboard_content.php';
    }

    public function manageusers(){
        include __DIR__ . '/../Views/events/manage_users.php';
    }

    public function users(){
        include __DIR__ . '/../Views/events/users.php';
    }

    public function role_requests(){
        include __DIR__ . '/../Views/events/role_requests.php';
    }

    public function useradd(){
        include __DIR__ . '/../Views/events/useradd.php';
    }

    public function manageevent(){
        include __DIR__ . '/../Views/events/manageevent.php';
    }

    public function approved_events(){
        include __DIR__ . '/../Views/events/approved_events.php';
    }

    public function events(){
        include __DIR__ . '/../Views/events/events.php';
    }

    public function viewevent(){
        include __DIR__ . '/../Views/events/viewevent.php';
    }

    public function approvedeventview(){
        include __DIR__ . '/../Views/events/approvedeventview.php';
    }

    public function inventory(){
        include __DIR__ . '/../Views/events/inventory.php';
    }
}
?>
