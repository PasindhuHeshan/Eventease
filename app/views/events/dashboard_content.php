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
            display: flex;
            /*gap: 10px;*/ /* Adds space between the two sections */
        }

        .left-part {
            flex: 2; /* Takes up 2 parts of the available space */
            border: 1px solid #ccc;
            padding: 0px;
            box-sizing: border-box; /* Includes padding and border in width calculation */
        }

        .right-part {
            flex: 1; /* Takes up 1 part of the available space */
            border: 1px solid #ccc;
            padding: 20px;
            box-sizing: border-box; /* Includes padding and border in width calculation */
        }


        a{
            text-decoration: none;
            color: inherit; 
        }
        .lower-section {
    display: flex;
    justify-content: space-between; /* Adds space between cards */
    gap: 10px; /* Adds spacing between the cards */
    border: none;
}

.lower-card {
    transition: transform 0.3s ease-in-out;
    flex: 1; /* Ensures all cards take up equal width */
    border: 1px solid #ccc; /* Adds a border for consistency */
    border-radius: 25px; /* Rounds the corners */
    padding: 10px; /* Adds padding for neatness */
    display: flex;
    align-items: center; /* Aligns the items vertically */
    justify-content: space-between; /* Ensures proper spacing between elements */
}

.lower-card:hover {
    transform: scale(1.02); /* Slightly increase the size on hover */
}

.data-row {
    display: flex;
    flex-direction: row; /* Aligns content horizontally */
    align-items: center; /* Aligns items vertically */
    justify-content: space-between; /* Adds spacing between the info and image */
    width: 100%; /* Takes the full width of the card */
}

.data-info {
    text-align: left;
    flex: 2; /* Gives more space to the info section */
    /* margin-right: 10px; Adds space between info and image */
}

.data-image {
    flex: 1; /* Gives less space to the image */
    display: flex;
    justify-content: center; /* Centers the image horizontally */
    align-items: center; /* Centers the image vertically */
}

.data-image img {
    width: 60%; /* Adjusts the image size */
    height: auto;
}


.data-title {
    font-weight: bold;
    margin-top: 10px;
    text-align: center; /* Centers the title */
}

.data-content {
    font-size: 25px;
    margin-top: 5px;
    text-align: center; /* Centers the content */
}

table {
    width: 100%; /* Full width table */
    border-collapse: collapse; /* Ensures clean borders */
    border: 1px solid #ccc; /* Matches the card border style */
    height: 300px; /* Set a height similar to card heights */
    box-sizing: border-box; /* Includes padding and border in the height calculation */
}

table th, table td {
    padding: 10px; /* Adds spacing within cells */
    text-align: center; /* Centers text inside cells */
    vertical-align: middle; /* Aligns content vertically */
    border: 1px solid #ccc; /* Matches card borders */
}

.left-part {
    display: flex; /* Applies Flexbox to the left section */
    flex-direction: column; /* Aligns table content vertically */
    height: 300px; /* Matches card height */
    justify-content: center; /* Centers the table vertically */
    box-sizing: border-box; /* Includes padding and border in height */
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
                            <img src="./images/bell.png" alt="Bell Icon">
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
                        <img src="./images/bell.png" alt="Bell Icon">
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
                        <img src="./images/bell.png" alt="Bell Icon">
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
                        <img src="./images/bell.png" alt="Bell Icon">
                    </div>
                </div>
            </div>
    </div>


            </main>
        </div>
    </body>
    </html>
