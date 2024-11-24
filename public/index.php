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
require __DIR__ . '/../app/Controllers/ContactusController.php';
require __DIR__ . '/../app/Controllers/UserProfileController.php';
require __DIR__ . '/../app/Controllers/ReqController.php';
require __DIR__ . '/../app/Models/Event.php';

use App\Database;
use App\Controllers\EventController;
use App\Controllers\HeaderController;
use App\Controllers\LoginController;
use App\Controllers\SigninController;
use App\Controllers\AdminLoginController;
use App\Controllers\ContactusController;
use App\Controllers\UserProfileController;
use App\Controllers\ReqController;

// Initialize the database connection
$database = new Database();
$db = $database->getConnection();

// Initialize the controller
$econtroller = new EventController($database);
$hcontroller = new HeaderController();
$lcontroller = new LoginController($database);
$scontroller = new SigninController($database);
$alcontroller = new AdminLoginController($database); 
$cucontroller = new ContactusController($database);
$upcontroller = new UserProfileController($database); 
$reqcontroller = new ReqController($database);
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
    case 'contactus.php':
        $hcontroller->render();
        $cucontroller->index();
        break;
    case 'userprofile.php':
        $hcontroller->render();
        $upcontroller->index();
        break;
    case 'uploadProfilePicture':
        $hcontroller->render();
        $upcontroller->uploadProfilePicture();
        break;
    case 'signin.php':
        $hcontroller->render();
        $scontroller->form();
        break;
    case 'forgetpassword.php':
        $hcontroller->render();
        $lcontroller->forgetpassword();
        break;
    case 'fpcheck':
        $hcontroller->render();
        $lcontroller->checkdetails();
        break;
    case 'fpchange':
        $hcontroller->render();
        $lcontroller->updatepassword();
        break;
    case 'changepassword.php': 
        $username = isset($_GET['username']) ? $_GET['username'] : '';
        $hcontroller->render(); 
        include __DIR__ . '/../app/Views/events/changepassword.php'; 
        break;
    case 'studentform.php':
        $hcontroller->render();
        $scontroller->studentform();
        break;
    case 'enroll.php':
        $hcontroller->render();
        $econtroller->eventenroll();
        break;
    case 'removeEnrollment.php':
        $hcontroller->render();
        $econtroller->removeEnrollment(); 
        break;
    case 'adminlogin.php':
        $alcontroller->form();
        break;
    case 'processadminlogin.php':
        $alcontroller->processlogin();
        break;  
    case 'dashboard.php':
        $alcontroller->dashboard();
        break;    
    case 'adminlogout.php':
        $alcontroller->logout();
        break;   
    case 'manage_users.php':
        $alcontroller->manageusers();
        break; 
    case 'users.php':
        $alcontroller->users();
        break; 
    case 'role_requests.php':
        $alcontroller->role_requests();
        break; 
    case 'useradd.php':
        $alcontroller->useradd();
        break;
    case 'manageevent.php':
        $alcontroller->manageevent();
        break;
    case 'approved_events.php':
        $alcontroller->approved_events();
        break;
    case 'events.php':
        $alcontroller->events();
        break;
    case 'approvedeventview.php':
        $alcontroller->approvedeventview();
        break;
    case 'viewevent.php':
        $alcontroller->viewevent();
        break;
    case 'inventory.php':
        $alcontroller->inventory();
        break;
    case 'add_item.php':
        $alcontroller->add_item();
        break;
    case 'save_item.php':
        $alcontroller->save_item();
        break;
    case 'delete_item.php':
        $alcontroller->delete_item();
        break;
    case 'get_item.php':
        $inventory_no = isset($_GET['$inventory_no']) ? $_GET['$inventory_no'] : '';
        include __DIR__ . '/../app/Views/events/modify_item.php';
        break;
    case 'modify_item.php':
        $alcontroller->modify_item();
        break;
    case 'RoleRequest.php':
        $hcontroller->render();
        $reqcontroller->req();
        break;
    case 'processreq':
        $hcontroller->render();
        $reqcontroller->processreq();
        break;
    default:
        $hcontroller->render();
        $econtroller->index();
        break;
}
?>
