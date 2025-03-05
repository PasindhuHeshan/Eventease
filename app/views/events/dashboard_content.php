<?php

require_once __DIR__ . '/../../Models/Dashboard.php';
require_once __DIR__ . '/../../Database.php';

use App\Database; 
use App\Models\Dashboard;

$database = new Database();
$dashboard = new Dashboard($database);

// Define the user types
$user_types = ['admin', 'staff', 'guest', 'organizer', 'student', 'support'];

// Initialize an array to store user counts
$user_counts = [];

// Retrieve user counts for each user type
foreach ($user_types as $type) {
    $user_counts[$type] = $dashboard->getUserCount($type);
}

// Map database values to display values
$display_user_types = [
    'admin' => 'Admin',
    'staff' => 'Academic Staff',
    'guest' => 'Guest',
    'organizer' => 'Event Organizer',
    'student' => 'Student',
    'support' => 'Support Staff'
];
?>

<?php 
    $parameter='dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/dashboardstyle.css">
    <style>
        .container {
            display: flex;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .upper-section, .lower-section {
            flex: 1;
            display: flex;
            margin-bottom: 20px;
        }
        .upper-section {
            flex-direction: row;
        }
        .left-part, .right-part {
            flex: 1;
            border: 1px solid #ccc;
            padding: 20px;
            margin-right: 10px;
        }
        .right-part {
            margin-right: 0;
        }
        .lower-section {
            display: flex;
            border: 1px solid #ccc;
            padding: 20px;
        }
        .lower-left, .lower-right {
            flex: 1;
            margin-right: 10px;
        }
        .lower-right {
            margin-right: 0;
        }
        .data-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .data-title {
            font-weight: bold;
        }
        </style>
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
        <?php include 'aside.php'; ?>

        <main class="main-content">
            <div class="upper-section">
                <div class="left-part">
                <table border="1" style="width:100%; border-collapse: collapse;">
                    <tr>
                        <th>User Type</th>
                        <th>New Count (this month)</th>
                        <th>User Count</th>
                    </tr>
                    <?php foreach ($user_types as $type): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($display_user_types[$type] ?? ''); ?></td>
                        <td style="color:green;"><?php if (isset($newuser_count[$type]) && $newuser_count[$type] !== null){echo '+'.htmlspecialchars($newuser_count[$type]);}else{echo '-';} ?></td> <!-- New user count -->
                        <td><?php echo htmlspecialchars($user_counts[$type] ?? ''); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                </div>
                <div class="right-part">
                    <div class="data-row">
                        <div class="data-title">Unresolved Org Privilege</div>
                        <div class="data-content">10</div>
                    </div>
                    <div class="data-row">
                        <div class="data-title">Unresolved Event Approvals</div>
                        <div class="data-content">5</div>
                    </div>
                    <div class="data-row">
                        <div class="data-title">Inventory Outages</div>
                        <div class="data-content">2</div>
                    </div>
                </div>
            </div>

            <div class="lower-section">
                <div class="lower-left">
                    <div class="data-row">
                        <div class="data-title">Disable Account Complaints</div>
                        <div class="data-content">3</div>
                    </div>
                </div>
                <div class="lower-right">
                    <div class="data-row">
                        <div class="data-title">Complaints</div>
                        <div class="data-content">3</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
