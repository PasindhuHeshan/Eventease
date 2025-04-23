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
            if ($username !== null) {
                $roleData = $this->usermodel->getRoleRequest($database, $userData['No']);
            } else {
                $roleData = null; // Handle the case where $no is null
            }
            $organization = $this->usermodel->getorganizations($database);
            require __DIR__ . '/../views/events/RoleRequest.php';
        }
        
    

        public function processreq(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                // Retrieve data from POST
                $no = $_POST['No'];
                $organization = $_POST['organization'];
                $role = $_POST['role'];
                $reason = $_POST['reason'];
                $status = isset($_POST['status']) ? $_POST['status'] : 'Pending'; // Default status if not provided
                $database = new Database(); // Ensure the database connection is created here

                if (isset($_GET['type']) && $_GET['type'] == "create") { 
                    $userModel = new UserModel(); 
                    $userModel->insertRoleRequest($no, $role, $organization, $reason, $status, $database); 
                    header('Location: userprofile.php'); 
                    exit();
                }
               
                // Redirect or load a confirmation page
                //$userData = $this->usermodel->getUserData($username, $database);
                //require __DIR__ . '/../Views/events/userprofile.php';
            
            }
            else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
                $no = $_POST['No'];
                $organization = $_POST['organization'];
                $role = $_POST['role'];
                $role = $_POST['role'];
                $reason = $_POST['reason'];
                $status = isset($_POST['status']) ? $_POST['status'] : 'Pending'; // Default status if not provided
                $database = new Database(); // Ensure the database connection is created here
                $userModel = new UserModel(); 
                $userModel->updateRoleRequest($no, $role, $organization, $reason, $status, $database); 
                header('Location: userprofile.php'); 
                exit();    
                    
            } 
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])){
                $no = $_POST['No'];
                $database = new Database();
                $userModel = new UserModel();
                $userModel->deleteRoleRequest($no, $database);
                header('Location: userprofile.php');
                exit();
            } else {
                // Redirect or load the form again
                require __DIR__ . '/../views/events/RoleRequest.php';
            }
        }
        
        
}