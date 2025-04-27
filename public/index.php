<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../app/Database.php';
require __DIR__ . '/../app/Models/UserModel.php';
require __DIR__ . '/../app/Models/connection.php';
require __DIR__ . '/../app/Models/EventModel.php';
require __DIR__ . '/../app/Models/contactus.php';
require __DIR__ . '/../app/Models/notifications.php';
require __DIR__ . '/../app/Models/EmailModel.php';
require __DIR__ . '/../app/Models/dashboard.php';
require __DIR__ . '/../app/Controllers/EventController.php';
require __DIR__ . '/../app/Controllers/HeaderController.php';
require __DIR__ . '/../app/Controllers/LoginController.php';
require __DIR__ . '/../app/Controllers/SigninController.php';
require __DIR__ . '/../app/Controllers/AdminLoginController.php';
require __DIR__ . '/../app/Controllers/ContactusController.php';
require __DIR__ . '/../app/Controllers/UserProfileController.php';
require __DIR__ . '/../app/Controllers/ReqController.php';
require __DIR__ . '/../app/Controllers/staffController.php';
require __DIR__ . '/../app/Models/Event.php';
require __DIR__ . '/../app/Controllers/EventsController.php';

use App\Database;
use App\Controllers\EventController;
use App\Controllers\HeaderController;
use App\Controllers\LoginController;
use App\Controllers\SigninController;
use App\Controllers\AdminLoginController;
use App\Controllers\ContactusController;
use App\Controllers\UserProfileController;
use App\Controllers\ReqController;
use App\Controllers\staffController;
use App\Controllers\EventsController;

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
$stfcontroller = new staffController($database);
$eocontroller = new EventsController($database);
// Get the URL parameter
$url = isset($_GET['url']) ? $_GET['url'] : '';

switch ($url) {
    case 'event.php':
        $hcontroller->render();
        $econtroller->event();
        break;
    case 'eventd.php':
        $hcontroller->render();
        $econtroller->eventd();
        break;
    case 'login.php':
        $hcontroller->render();
        $lcontroller->form();
        break;
    case 'processlogin':
        $lcontroller->processlogin();
        break;
    case 'processsignin':
        $hcontroller->render();
        $scontroller->processsignin();
        break;
    // case 'processRegistration':
    //     $hcontroller->render();
    //     $hcontroller->processRegistration();
    //     break;
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
    case 'updateProfile.php':
        $hcontroller->render();
        $upcontroller->updateProfile();
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
    case 'guestform.php':
        $hcontroller->render();
        $scontroller->guestform();
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
        $hcontroller->render();
        $alcontroller->form();
        break;
    case 'processadminlogin.php':
        $hcontroller->render();
        $alcontroller->processlogin();
        break;  
    case 'dashboard.php':
        $hcontroller->render();
        $alcontroller->dashboard();
        break;    
    case 'adminlogout.php':
        $hcontroller->render();
        $alcontroller->logout();
        break;   
    case 'manage_users.php':
        $hcontroller->render();
        $alcontroller->manageusers();
        break; 
    case 'role_requests.php':
        $hcontroller->render();
        $alcontroller->role_requests();
        break;
    case 'useradd.php':
        $hcontroller->render();
        $alcontroller->useradd();
        break;
    case 'changestatus':
            $hcontroller->render();
            $alcontroller->changestatus();
            break;
    case 'disableacc.php':
            $hcontroller->render();
            $alcontroller->disableacc();
            break;
    case 'feedback.php':
            $hcontroller->render();
            $alcontroller->getfeedbacks();
            break;
    case 'feedbackdone':
            $hcontroller->render();
            $alcontroller->feedbackdone();
            break;
    case 'activeacc':
            $hcontroller->render();
            $alcontroller->activeacc();
            break;
    case 'replyfeedback':
            $hcontroller->render();
            $alcontroller->replyfeedback();
            break;
    case 'send_email_form':
            $hcontroller->render();
            $alcontroller->showSendEmailForm();
            break;
    case 'process_send_email':
            $alcontroller->processSendEmail();
            break;
    case 'manageevent.php':
        $hcontroller->render();
        $alcontroller->manageevent();
        break;
    
    case 'events.php':
        $hcontroller->render();
        $alcontroller->events();
        break;
    
    case 'viewevent.php':
        $hcontroller->render();
        $alcontroller->viewevent();
        break;
    case 'inventory.php':
        $hcontroller->render();
        $alcontroller->inventory();
        break;
    case 'add_item.php':
        $hcontroller->render();
        $alcontroller->add_item();
        break;
    case 'import_excel.php':
        $hcontroller->render();
        $alcontroller->importExcel();
        break;
    case 'save_item.php':
        $hcontroller->render();
        $alcontroller->save_item();
        break;
    case 'delete_item.php':
        $hcontroller->render();
        $alcontroller->delete_item();
        break;
    case 'get_item.php':
        $hcontroller->render();
        $alcontroller->get_item();
        break;
    case 'modify_item.php':
        $hcontroller->render();
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
    // case 'approve_events':
    //     $hcontroller->render();
    //     $stfcontroller->index();
    //     break;
    case 'myevents':
        $hcontroller->render();
        $eocontroller->index();
        break;
    case 'getNotApprovedEvents':
        $hcontroller->render();
        $econtroller->getNotApprovedEvents();
        break;
    case 'acceptevent':
        $hcontroller->render();
        $econtroller->acceptevent();
        break;
    case 'rejectevent':
        $hcontroller->render();
        $econtroller->rejectevent();
        break;
    case 'contactus':
        $hcontroller->render();
        $cucontroller->contactus();
        break;
    case 'createform':
        $hcontroller->render();
        $eocontroller->createform();
        break;
    case 'createevent':
        $hcontroller->render();
        $eocontroller->createevent();
        break;
    case 'processEvent':
        $hcontroller->render();
        $eocontroller->processEvent();
        break;
    case 'addmore':
        $hcontroller->render();
        $eocontroller->addmore();
        break;
    case 'supportEvents':
        $hcontroller->render();
        $upcontroller->assignedevents();
        break;
    case 'enrollment':
        $hcontroller->render();
        $upcontroller->enrollstd();
        break;
    case 'report':
        $hcontroller->render();
        $upcontroller->report();
        break;
    case 'review':
        $hcontroller->render();
        $upcontroller->review();
        break;
    case 'inquiry':
        $hcontroller->render();
        $upcontroller->inquiry();
        break;
    case 'statistics':
        $hcontroller->render();
        $upcontroller->stat();
        break;
    /*case 'acaform':
        $hcontroller->render();
        $stfcontroller->aca();
        break;*/

  
    case 'chat.php':
        $hcontroller->render();
        $cucontroller->chat();
        break;
  
    case 'deleteAccount':
        $hcontroller->render();
        $upcontroller->deleteAccount();
        break;
    case 'deletetoindex':
        $hcontroller->render();
        $econtroller->deletetoindex();
    case 'adminviewevent':
        $hcontroller->render();
        $alcontroller->adminviewevent();
        break;
    case 'handleinventory':
        $hcontroller->render();
        $alcontroller->handleinventory();
        break;

    // case 'rejectcomplaint':
    //     $hcontroller->render();
    //     $alcontroller->rejectcomplaint();
    //     break;

    case 'ask.php':
        $hcontroller->render();
        $cucontroller->ask();
        break;
    case 'submitask':
        $hcontroller->render();
        $cucontroller->submitask();
        break;
    default:
        $hcontroller->render();
        $econtroller->index();
        break;
}
?>
