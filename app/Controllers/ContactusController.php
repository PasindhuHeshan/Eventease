<?php

namespace App\Controllers;

use App\Models\contactus;
use App\Models\UserModel;
use App\Database;

class ContactusController{
    private $conn;

    public function index() {
        unset($_SESSION['errors']);
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $database = new Database();
        $usermodel = new UserModel();
        $userData = $usermodel->getUserData($username, $database);
        require __DIR__ . '/../Views/events/contactus.php';
    }

    public function contactus(){
    
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : null;
    $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;

    $errors = [];

    if ($type === null || $email === null || $contact_no === null || $feedback === null) {
        $errors[] = "Missing required fields";
    }

    if (strlen($contact_no) != 10 || !ctype_digit($contact_no)) {
        $errors['contact_no'] = "Contact number must be exactly 10 digits.";
    }

    if ($type=='2' && strpos($email, '@stu.ucsc.cmb.ac.lk') === false) {
        $errors['email'] = "Email must be a valid address";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        include __DIR__ . '/../Views/events/contactus.php';
        exit();
    }
    
    $database = new Database();
    $contactus = new contactus();
    $usermodel = new UserModel();
    
    if($type === '2'){
        $userData = $usermodel->getUserDatabyemail($email, $database);

        if($userData){
            $contactus->disableacc($userData['No'], $type, $contact_no, $feedback, $database);
            unset($_SESSION['errors']);
        }else{
            $errors['email'] = "Email not found in the database.";
            $_SESSION['errors'] = $errors;
        }
        include __DIR__ . '/../Views/events/contactus.php';
    } else {
        $database = new Database();
        $contactus = new contactus();
        $contactus->feedback($name ,$type, $email, $contact_no, $feedback, $database);
        unset($_SESSION['errors']);
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $userData = $usermodel->getUserData($username, $database);
        include __DIR__ . '/../Views/events/contactus.php';
    }
        
    // if ($this->eventModel->insertContactUs($type, $email, $contact_no, $feedback)) {
    //     unset($_SESSION['errors']); // Clear errors on successful submission
    //     include __DIR__ . '/../Views/events/contactus.php';
    // } else {
    //     echo "Error submitting feedback";
    // }
    }

    public function chat() {
        $database = new Database();
        $usermodel = new UserModel();
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $userData = $usermodel->getUserData($username, $database);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
            $no = isset($_POST['no']) ? $_POST['no'] : null;
            $database = new Database();

            $message = isset($_POST['message']) ? $_POST['message'] : null;

            $contactus = new contactus();
            if($userData['usertype']=='0'){
                $contactus->insertadminChat($no, $message, $database);
            }else{
                $contactus->insertChat($no, $message, $database);
            }
        }
        
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        
        if (!$userData) {
            $_SESSION['errors'] = ["Error: User not found."];
            require __DIR__ . '/../Views/events/chat.php';
            exit();
        }

        if($email && $userData['usertype']=='0'){
            $contactus = new contactus();
            $chats = $contactus->getChatDetails($email, $database);
            require __DIR__ . '/../Views/events/chat.php';
        }else{
            $contactus = new contactus();
            $contactus->updateopentime($userData['email'], $database);
            $chats = $contactus->getChatDetails($userData['email'], $database);
            require __DIR__ . '/../Views/events/chat.php';
        }
        
    }
}