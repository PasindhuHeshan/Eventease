<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../app/Database.php';
require __DIR__ . '/../app/Models/UserModel.php';
require __DIR__ . '/../app/Models/connection.php';
require __DIR__ . '/../app/Models/EventModel.php';
require __DIR__ . '/../app/Controllers/EventController.php';
require __DIR__ . '/../app/Controllers/HeaderController.php';
require __DIR__ . '/../app/Controllers/LoginController.php';
require __DIR__ . '/../app/Controllers/SigninController.php';
require __DIR__ . '/../app/Controllers/AdminLoginController.php';
require __DIR__ . '/../app/Models/Event.php';

use App\Database;
use App\Controllers\EventController;
use App\Controllers\HeaderController;
use App\Controllers\LoginController;
use App\Controllers\SigninController;
use App\Controllers\AdminLoginController;

// Initialize the database connection
$database = new Database();
$db = $database->getConnection();

// Initialize the controller
$econtroller = new EventController($database);
$hcontroller = new HeaderController();
$lcontroller = new LoginController($database);
$scontroller = new SigninController($database);
$alcontroller = new AdminLoginController($database); 
// Get the URL parameter
$url = isset($_GET['url']) ? $_GET['url'] : '';

switch ($url) {
    case 'event.php':
        $hcontroller->render();
        $econtroller->event();
        break;
    case 'login.php':
        $hcontroller->render();
        $lcontroller->form();
        break;
    case 'processlogin':
        $hcontroller->render();
        $lcontroller->processlogin();
        break;
    case 'logout.php':
        $lcontroller->logout();
        break;
    case 'signin.php':
        $hcontroller->render();
        $scontroller->form();
        break;
    case 'studentform.php':
        $hcontroller->render();
        $scontroller->studentform();
        break;
    case 'adminlogin.php':
        $alcontroller->form();
        break;
    case 'processadminlogin.php':
        $alcontroller->processlogin();
        break;  
    default:
        $hcontroller->render();
        $econtroller->index();
        break;
}
?>
