<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Database;

class SigninController {
    public function processsignin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = $_POST['fname'] ?? null;
            $lname = $_POST['lname'] ?? null;
            $email = $_POST['email'] ?? null;
            $contactno1 = $_POST['contactno1'] ?? null;
            $contactno2 = $_POST['contactno2'] ?? null;
            $address = $_POST['address'] ?? null;
            $city = $_POST['city'] ?? null;
            $id = $_POST['id'] ?? '00';
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $confirm_password = $_POST['confirm_password'] ?? null;
            $usertype = $_POST['usertype'] ?? null;
            $page = $_POST['page'] ?? null;
            $profile_picture = null;
            $status = '1';
    
            if ($username && $password && $confirm_password && $password === $confirm_password) {
                $database = new Database();
                $userModel = new UserModel();
    
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                if($page=='academic'){
                    $updateuser=$userModel->updateUserProfile($username, $hashedPassword, $fname, $lname, $email,$id, $address, $city,$status, $database);
                }else{
                    $isUserCreated = $userModel->createUser(
                        $username, $hashedPassword, $fname, $lname, $email, 
                        $usertype, $id, $address, $city, $profile_picture, $status,
                        $database
                    );
                }
    
                if ($isUserCreated || $updateuser) {
                    $userId = $userModel->getUserData($username,$database)['No'];
    
                    if ($contactno1) {
                        $userModel->createContactNumber($userId, $contactno1, $database);
                    }
                    if ($contactno2) {
                        $userModel->createContactNumber($userId, $contactno2, $database);
                    }
    
                    if(isset($_POST['formname'])){
                        header("Location: ../public/login.php?message=1");    
                        exit();
                    }else{
                        header("Location: ../public/login.php?message=2");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'User creation failed!';
                    header("Location: ../public/index.php?url=signin.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Passwords do not match or missing required fields!';
                header("Location: ../public/index.php?url=signin.php");
                exit();
            }
        } else {
            $this->form();
        }
    }

    public function form() {
        $error = $_SESSION['error'] ?? null;

        include __DIR__ . '/../Views/events/signinform.php';
    }
    public function studentform() {
        $error = $_SESSION['error'] ?? null;

        $usermodel = new UserModel();
        $database = new Database();

        $usernames = $usermodel->getusernames($database);
        $emails = $usermodel->getemails($database);


        include __DIR__ . '/../Views/events/studentform.php';
    }

    public function guestform() {
        $error = $_SESSION['error'] ?? null;

        $usermodel = new UserModel();
        $database = new Database();
        $usernames = $usermodel->getusernames($database);
        $emails = $usermodel->getemails($database);
        include __DIR__ . '/../Views/events/guestform.php';
    }
}