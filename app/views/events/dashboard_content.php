<?php

require_once __DIR__ . '/../../Models/Dashboard.php';
require_once __DIR__ . '/../../Database.php';

use App\Database; 
use App\Models\Dashboard;

$database = new Database();
$dashboard = new Dashboard($database);

//Define the user types
$user_types = ['admin', 'staff', 'guest', 'organizer', 'student', 'support'];

//to Initialize an array to store user counts
$user_counts = [];

//Retrieve user counts for each user type
foreach ($user_types as $type) {
    $user_counts[$type] = $dashboard->getUserCount($type);
}

//Map database values to display values
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
   
</head>
<body>
    
    <div class="container">
        <?php include 'aside.php'; ?>

        <main class="main-content">
            <div class="upper-section">
                <div class="left-part">
                <table border="1" style="width:100%; border-collapse: collapse;">
                    <tr>
                        <th>User Type</th>
                        <th>New Users (<?php echo date('F'); ?>)</th>
                        <th>Total</th>
                    </tr>
                    <?php foreach ($user_types as $type): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($display_user_types[$type] ?? ''); ?></td>
                        <td style="color:green;"><?php if (isset($newuser_count[$type]) && $newuser_count[$type] !== null){echo '+'.htmlspecialchars($newuser_count[$type]);}else{echo '-';} ?></td>
                        <td><?php echo htmlspecialchars($user_counts[$type] ?? ''); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                </div>
                <div class="lower-card">
                    <a href="role_requests.php">
                    <div class="data-row">
                        <div class="data-info">
                            <div class="data-title">Pending Organizational Privilege Requests</div>
                            <div class="data-content"><?php echo htmlspecialchars($roleRequestscount ?? '-'); ?></div>
                        </div>
                        <div class="data-image">
                            <img src="./images/privilage.png" alt="privilage Icon">
                        </div>
                    </div>
                    </a>
                </div>

            </div>

            <div class="lower-section">
            <div class="lower-card">
                <a href="manageevent.php">
                <div class="data-row">
                    <div class="data-info">
                        <div class="data-title">Pending Event Approvals</div>
                        <div class="data-content"><?php echo htmlspecialchars($eventcount ?? '-'); ?></div>
                    </div>
                    <div class="data-image">
                        <img src="./images/pendingapproval.png" alt="pendingapproval Icon">
                    </div>
                </div>
                </a>
            </div>
    
            <div class="lower-card">
            <a href="disableacc.php">
                <div class="data-row">
                    <div class="data-info">
                        <div class="data-title">Disable Account Complaints</div>
                        <div class="data-content">3</div>
                    </div>
                    <div class="data-image">
                        <img src="./images/DisAccComplaints.png" alt="DisAccComplaints Icon">
                    </div>
                </div>
                </a>
            </div>

            <div class="lower-card">
            <a href="feedback.php">
                <div class="data-row">
                    <div class="data-info">
                        <div class="data-title">Complaints</div>
                        <div class="data-content">3</div>
                    </div>
                    <div class="data-image">
                        <img src="./images/complaint.png" alt="complaint Icon">
                    </div>
                </div>
            </div>
            </a>
    </div>


            </main>
        </div>
    </body>
    </html>
