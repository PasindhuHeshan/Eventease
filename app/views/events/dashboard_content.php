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
            display: flex;
        }

        .left-part {
            flex: 2;
            border: 1px solid #ccc;
            padding: 0px;
            box-sizing: border-box; 
        }

        .right-part {
            flex: 1; 
            border: 1px solid #ccc;
            padding: 20px;
            box-sizing: border-box; 
        }


        a{
            text-decoration: none;
            color: inherit; 
        }
        .lower-section {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        border: none;
        }

.lower-card {
    flex: 1; 
    border: 1px solid #ccc;
    border-radius: 25px;
    padding: 10px; 
    display: flex;
    align-items: center; 
    justify-content: space-between; 
    background: linear-gradient(to right, rgb(156, 199, 215), rgb(200, 230, 240));
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    width: 280px;
    height: 260px;
    
}


.lower-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.data-row {
    display: flex;
    flex-direction: row; 
    align-items: center; 
    justify-content: space-between; 
    width: 100%; 
}

.data-info {
    text-align: left;
    flex: 2;
}

.data-image {
    flex: 1; 
    display: flex;
    justify-content: center; 
    align-items: center;
}

.data-image img {
    width: 60%; 
    height: auto;
}


.data-title {
    font-weight: bold;
    margin-top: 10px;
    font-size: 20px;
    text-align: center; 
}

.data-content {
    font-size: 25px;
    margin-top: 5px;
    text-align: center; 
}

table {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 20px;
    overflow: hidden;
    height: 300px;
    box-sizing: border-box; 
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px; 
    text-align: center;
    vertical-align: middle;
}

table th {
    background-color:rgba(176, 203, 210, 0.92);
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}
table tr:nth-child(odd) {
    background-color:rgba(232, 241, 247, 0.96);
}

table tr:hover {
    background-color:rgba(232, 241, 247, 0.96);
}

table td:nth-child(2) {
    width: 30%; 
}

table td:nth-child(3) {
    width: 30%; 
}

.left-part {
    display: flex; 
    flex-direction: column;
    height: 300px; 
    justify-content: center; 
    box-sizing: border-box;
    border-radius: 16px;
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
                <div class="data-row">
                    <div class="data-info">
                        <div class="data-title">Disable Account Complaints</div>
                        <div class="data-content">3</div>
                    </div>
                    <div class="data-image">
                        <img src="./images/DisAccComplaints.png" alt="DisAccComplaints Icon">
                    </div>
                </div>
            </div>

            <div class="lower-card">
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
    </div>


            </main>
        </div>
    </body>
    </html>
