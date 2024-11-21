<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Database;

session_start();

class LoginController {
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
                    header("Location: ../public/index.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Incorrect Username or Password!';
                    header("Location: ../public/index.php?url=login.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Please enter both username and password!';
                header("Location: ../public/index.php?url=login.php");
                exit();
            }
        } else {
            $this->form();
        }
    }

    public function form() {
        $error = $_SESSION['error'] ?? null;
        //unset($_SESSION['error']);

        include __DIR__ . '/../Views/events/loginform.php';
    }

    public function forgetpassword(){
        include __DIR__ . '/../Views/events/forgetpassword.php';
    }

    public function checkdetails() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;

        if ($username && $email) {
            $database = new Database();
            $userModel = new UserModel();
            $isValidUser = $userModel->fpcheck($username, $email, $database);
            if($isValidUser){
                //$_SESSION['username'] = $username;
                //include __DIR__ . '/../Views/events/changepassword.php';
                header("Location: ../public/index.php?url=changepassword.php&username=" . urlencode($username));
            }else{
                $_SESSION['error'] = 'Incorrect Username or Email!';
                header("Location: ../public/index.php?url=forgetpassword.php");
                exit();
            }
        } else {
            $_SESSION['error'] = 'Please enter both username and email!';
            header("Location: ../public/index.php?url=forgetpassword.php");
            exit();
        }
    }
    }

    public function updatepassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $password2 = $_POST['password2'] ?? null;
    
            // Debugging statements to check variable values
            error_log("Username: " . $username);
            error_log("Password: " . $password);
            error_log("Password2: " . $password2);
    
            if ($username && $password && $password2) {
                $database = new Database();
                $userModel = new UserModel();
    
                if ($password != $password2) {
                    $_SESSION['error'] = 'New passwords mismatch';
                    header("Location: ../public/index.php?url=changepassword.php&username=" . urlencode($username));
                    exit();
                }
    
                $status = $userModel->fpchange($username, $password, $database);
                if ($status) {
                    header("Location: ../public/index.php?url=login.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Failed to update password';
                    header("Location: ../public/index.php?url=changepassword.php&username=" . urlencode($username));
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Please fill in all fields';
                header("Location: ../public/index.php?url=changepassword.php&username=" . urlencode($username));
                exit();
            }
        }
    }
    

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
}
