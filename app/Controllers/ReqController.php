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
            } 
            $organization = $this->usermodel->getorganizations($database);
            require __DIR__ . '/../views/events/RoleRequest.php';
        }
        
    

        public function processreq(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                
                $no = $_POST['No'];
                $organization = $_POST['organization'];
                $role = $_POST['role'];
                $reason = $_POST['reason'];
                $status = isset($_POST['status']) ? $_POST['status'] : 'Pending'; 
                $database = new Database(); 

                if (isset($_GET['type']) && $_GET['type'] == "create") { 
                    $userModel = new UserModel(); 
                    $userModel->insertRoleRequest($no, $role, $organization, $reason, $status, $database); 
                    header('Location: userprofile.php'); 
                    exit();
                }
               
            
            }
            else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
                $no = $_POST['No'];
                $organization = $_POST['organization'];
                $role = $_POST['role'];
                $role = $_POST['role'];
                $reason = $_POST['reason'];
                $status = isset($_POST['status']) ? $_POST['status'] : 'Pending';
                $database = new Database(); 
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
                
                require __DIR__ . '/../views/events/RoleRequest.php';
            }
        }
        
        
}