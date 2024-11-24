<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Database;

class ReqController{
    
        private $user;
        private $username;
        private $usermodel;
    
        public function __construct(Database $database)
        {
            $this->usermodel = new UserModel($database);
        }
    
        public function req() {
            $database = new Database();
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
            $userData = $this->usermodel->getUserData($username,$database);
            require __DIR__ . '/../Views/events/RoleRequest.php';
        }
        /*public function processreq(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                echo "<script> alert('data giya'); </script>";
                $database = new Database(); // Ensure the database connection is created here
                $username = isset($_POST['name']) ? $_POST['name'] : null;
                $email = isset($_POST['email']) ? $_POST['email'] : null;
                $role = isset($_POST['role']) ? $_POST['role'] : null;
                $reason = isset($_POST['reason']) ? $_POST['reason'] : null;
                $status = 'Pending';
                $userModel->insertRoleRequest($username, $email, $role, $reason, $status, $database);
                $userData = $this->usermodel->getUserData($username,$database);
                require __DIR__ . '/../Views/events/userprofile.php';
            }
            else{
                $userData = $this->usermodel->getUserData($username,$database);
                require __DIR__ . '/../Views/events/userprofile.php';
            }

        }*/

        public function processreq(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                // Retrieve data from POST
                $username = $_POST['name'];
                $email = $_POST['email'];
                $role = $_POST['role'];
                $reason = $_POST['reason'];
                $status = isset($_POST['status']) ? $_POST['status'] : 'Pending'; // Default status if not provided
                $database = new Database(); // Ensure the database connection is created here

                if (isset($_GET['type']) && $_GET['type'] == "update") { 
                    $userModel = new UserModel(); 
                    $userModel->updateRoleRequest($username, $email, $role, $reason, $status, $database); 
                    header('Location: userprofile.php'); 
                    exit(); 
                } else { 
                    $userModel = new UserModel(); 
                    $userModel->insertRoleRequest($username, $email, $role, $reason, $status, $database); 
                    header('Location: userprofile.php'); 
                    exit();
                }
                
                // Insert data into the database
                
                
                // Redirect or load a confirmation page
                $userData = $this->usermodel->getUserData($username, $database);
                //require __DIR__ . '/../Views/events/userprofile.php';
            } else {
                // Redirect or load the form again
                require __DIR__ . '/../Views/events/RoleRequest.php';
            }
        }
        
}