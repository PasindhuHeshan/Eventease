<?php

require_once __DIR__ . '/../../Models/Dashboard.php';
require_once __DIR__ . '/../../Database.php';

use App\Database; 
use App\Models\Dashboard;

$database = new Database();
$dashboard = new Dashboard($database);

$user_count = 0;
$event_count = 0;
$inventory_count = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user_type'])) {
        $user_type = $_POST['user_type'];
        $user_count = $dashboard->getUserCount($user_type);
    }

    if (isset($_POST['event_type'])) {
        $event_type = $_POST['event_type'];
        $event_count = $dashboard->getEventCount($event_type);
    }

    if (isset($_POST['inventory_type'])) {
        $inventory_type = $_POST['inventory_type'];
        $inventory_count = $dashboard->getInventoryCount($inventory_type);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/dashboardstyle.css">
</head>
<body>
    <header>
        <p>Hello</p>
        <div class="header-right">
            <span>, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <form method="POST" action="adminlogout.php">
                <button type="submit" class="logout-button">Log out</button>
            </form>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <div class="profile-section">
                <div class="profile-icon">
                    <img src="./images/adminlogo.png" alt="Profile">
                </div>
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>
            <ul>
                <li class="active">Dashboard</li>
                <!-- <li><a>Dashboard</a></li> -->
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="manageevent.php">Approve Events</a></li>
                <li><a href="inventory.php">Manage Inventory</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <!-- User Type Section -->
            <form id="filter-form" action="dashboard.php" method="POST">
                <div class="card">
                    <h3>User Type</h3>
                    <select name="user_type" onchange="this.form.submit()">
                        <option value="staff" <?php if(isset($user_type) && $user_type == 'staff') echo 'selected'; ?>>Staff Member</option>
                        <option value="organizers" <?php if(isset($user_type) && $user_type == 'organizers') echo 'selected'; ?>>Event Organizers</option>
                        <option value="student" <?php if(isset($user_type) && $user_type == 'student') echo 'selected'; ?>>Student</option>
                    </select>
                    <p>Users: <?php echo $user_count; ?></p>
                </div>
            </form>

            <!-- Event Type Section -->
            <form id="filter-form" action="dashboard.php" method="POST">
                <div class="card">
                    <h3>Event Type</h3>
                    <select name="event_type" onchange="this.form.submit()">
                        <option value="Social" <?php if(isset($event_type) && $event_type == 'Social') echo 'selected'; ?>>Social</option>
                        <option value="Educational" <?php if(isset($event_type) && $event_type == 'Educational') echo 'selected'; ?>>Educational</option>
                        <option value="Entertainment" <?php if(isset($event_type) && $event_type == 'Entertainment') echo 'selected'; ?>>Entertainment</option>
                        <option value="Culture" <?php if(isset($event_type) && $event_type == 'Culture') echo 'selected'; ?>>Culture</option>
                        <option value="Charity" <?php if(isset($event_type) && $event_type == 'Charity') echo 'selected'; ?>>Charity</option>
                        <option value="Music" <?php if(isset($event_type) && $event_type == 'Music') echo 'selected'; ?>>Music</option>
                    </select>
                    <p>Events: <?php echo $event_count; ?></p>
                </div>
            </form>

            <!-- Inventory Section -->
            <form id="inventory-form" method="POST" action="dashboard.php">
                <div class="card">
                    <h3>Inventory</h3>
                    <select name="inventory_type" onchange="this.form.submit()">
                        <option value="Appliances" <?php if(isset($inventory_type) && $inventory_type == 'Appliances') echo 'selected'; ?>>Appliances</option>
                        <option value="Stationery" <?php if(isset($inventory_type) && $inventory_type == 'Stationery') echo 'selected'; ?>>Stationery</option>
                        <option value="Furniture" <?php if(isset($inventory_type) && $inventory_type == 'Furniture') echo 'selected'; ?>>Furniture</option>
                        <option value="Electronics" <?php if(isset($inventory_type) && $inventory_type == 'Electronics') echo 'selected'; ?>>Electronics</option>
                    </select>
                    <p>Inventories: <?php echo $inventory_count; ?></p>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
