<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Dashboard;
use App\Database;

require_once __DIR__ . '/../Models/Dashboard.php';

class AdminLoginController {
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
                    header("Location: ../public/index.php?url=dashboard.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Incorrect Username or Password!';
                    header("Location: ../public/index.php?url=adminlogin.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Please enter both username and password!';
                header("Location: ../public/index.php?url=adminlogin.php");
                exit();
            }
        } else {
            $this->form();
        }
    }

    public function form() {
        $error = $_SESSION['error'] ?? null;
        include __DIR__ . '/../Views/events/adminlogin.php';
    }

    public function logout(){
        //session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    public function dashboard() {
        $database = new Database();
        $dashboard = new Dashboard($database);

        $user_count = $dashboard->getUserCount('user_type');
        $event_count = $dashboard->getEventCount('event_type');
        $inventory_count = $dashboard->getInventoryCount('inventory_type');

        include __DIR__ . '/../Views/events/dashboard_content.php';
    }

    public function manageusers(){
        include __DIR__ . '/../Views/events/manage_users.php';
    }

    public function users(){
        include __DIR__ . '/../Views/events/users.php';
    }

    public function role_requests(){
        include __DIR__ . '/../Views/events/role_requests.php';
    }

    public function useradd(){
        include __DIR__ . '/../Views/events/useradd.php';
    }

    public function manageevent(){
        include __DIR__ . '/../Views/events/manageevent.php';
    }

    public function approved_events(){
        include __DIR__ . '/../Views/events/approved_events.php';
    }

    public function events(){
        include __DIR__ . '/../Views/events/events.php';
    }

    public function viewevent(){
        include __DIR__ . '/../Views/events/viewevent.php';
    }

    public function approvedeventview(){
        include __DIR__ . '/../Views/events/approvedeventview.php';
    }

    public function Inventory() {

        $database = new Database();
        $dashboard = new Dashboard($database);

        // Check if 'inventory_type' is set, otherwise default to 'Appliances'
        $inventory_type = isset($_POST['inventory_type']) ? $_POST['inventory_type'] : 'Appliances';

        // Fetch inventory data
        $result = $dashboard->getInventoryByType($inventory_type);

        // Include the view file
        include __DIR__ . '/../Views/events/inventory.php';
    }

    public function add_item(){
        include __DIR__ . '/../views/events/add_item.php';
    }

    public function save_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item = $_POST['item'] ?? null;
            $inventory_no = $_POST['inventory_no'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $inventory_type = $_POST['inventory_type'] ?? null;

            $database = new Database();
            $dashboard = new Dashboard($database);

            if ($dashboard->save_item($item, $inventory_no, $quantity, $inventory_type)) {
                include __DIR__ . '/../views/events/inventory.php';
            } else {
                echo "Not added.";
            }
        }
    }

    public function delete_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inventory_no']) && isset($_POST['inventory_type'])) {
            $inventory_no = $_POST['inventory_no'];
            $inventory_type = $_POST['inventory_type'] ?? 'Appliances';
            $database = new Database();
            $dashboard = new Dashboard($database);
    
            if($dashboard->check_item_usage($inventory_no)){
                //check if the Selected inventory have assigned to any event (at least one event)
                if ($dashboard->delete_item($inventory_no)) {
                    //header("Location: inventory.php");
                    include __DIR__ . '/../views/events/inventory.php';
                    exit();
                } else {
                    echo "Error deleting item.";
                }
            }else{
                //echo "Item is in use. Cannot delete.";
                include __DIR__ . '/../views/events/inventory.php';
                exit();
            }
        }
    }
   
   
    
    public function modify_item() {
        $database = new Database();
        $dashboard = new Dashboard($database);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle POST data here
            $inventoryNo = $_POST['inventory_no'] ?? null;
            $item = $_POST['item'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $inventoryType = $_POST['inventory_type'] ?? null;
            
            if($dashboard->before_modify($inventoryNo,$quantity)){
                if ($inventoryNo && $item && $quantity && $inventoryType) {
                    try {
                        if ($dashboard->modify_item($inventoryNo, $item, $quantity, $inventoryType)) {
                            header("Location: inventory.php");
                            exit();
                        } else {
                            echo "Error modifying item.";
                        }
                    } catch (Exception $e) {
                        echo "An error occurred: " . $e->getMessage();
                    }
                } else {
                    echo "Missing data for modification.";
                }
            }else{
                echo "Enter the Modified Quantity below the available Quantity";
            }
        } else {
            // Check if inventory_no is provided via GET
            $inventoryNo = $_GET['inventory_no'] ?? null;
    
            if ($inventoryNo) {
                $itemData = $dashboard->getItemByInventoryNo($inventoryNo);
    
                if ($itemData) {
                    // Pass item data to the view
                    include __DIR__ . '/../views/events/modify_item.php';
                } else {
                    echo "Item not found.";
                }
            } else {
                echo "Inventory number is missing.";
            }
        }
    }
    

    public function get_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inventory_no'])) {
            $inventory_no = $_POST['inventory_no'];
            $database = new Database();
            $dashboard = new Dashboard($database);
    
            if ($inventory_no) {
                $itemData = $dashboard->getItemByInventoryNo($inventory_no);
    
                if ($itemData) {
                    // Redirect to the edit item view, passing the item data
                    $_SESSION['itemData'] = $itemData;
                    include __DIR__ . '/../Views/events/modify_item.php';
                    exit;
                } else {
                    echo "Item not found.";
                }
            } else {
                echo "Inventory number is missing.";
            }
        }
    }
    
    
}
?>
