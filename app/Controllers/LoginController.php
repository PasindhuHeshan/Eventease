<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\EventModel;
use App\Database;

session_start();

class LoginController {
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['name'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($username && $password) {
                $database = new Database(); 
                $userModel = new UserModel($database);
                $eventModel = new EventModel($database);
                $userData = $userModel->getUserData($username, $database);
                $upevents = $eventModel->getAllupcomingEvents($username);

                if ($userData) {
                    if ($userData['status'] == 0) {
                        if ($userData['id']==null) {
                            require __DIR__ . '/../views/events/academic.php';
                            exit();
                        }else{
                            $_SESSION['error'] = 'Account blocked!<br>Contact administration!';
                            header("Location: ../public/index.php?url=login.php");
                            exit();
                        }
                    }

                    if (password_verify($password, $userData['password'])) {
                        $_SESSION['username'] = $username;
                        $_SESSION['no'] = $userData['no'];
                        $_SESSION['upevent'] = $upevents;
                        $_SESSION['profile_picture'] = $userData['profile_picture'];

                        switch ($userData['role_name']) {
                            case 'Student':
                            case 'Guest':
                            case 'Academic':
                            case 'Organizer':
                            case 'Support Staff':
                                header("Location: ../public/index.php");
                                break;
                            default:
                                header("Location: ../public/dashboard.php");
                                break;
                        }
                        exit();
                    } else {
                        $_SESSION['error'] = 'Incorrect Password!';
                        header("Location: ../public/index.php?url=login.php");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'Incorrect Username!';
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

    public function forgetpassword() {
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
                if ($isValidUser) {
                    header("Location: ../public/index.php?url=changepassword.php&username=" . urlencode($username));
                } else {
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

            if ($username && $password && $password2) {
                $database = new Database();
                $userModel = new UserModel();

                if ($password != $password2) {
                    $_SESSION['error'] = 'New passwords mismatch';
                    header("Location: ../public/index.php?url=changepassword.php&username=" . urlencode($username));
                    exit();
                }

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $status = $userModel->fpchange($username, $hashedPassword, $database);
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
