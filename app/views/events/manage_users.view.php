<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="mngusrstyle.css">
</head>
<body>
    <header>
        <p>Hello , admin</p>
            
        </div>
    </header>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-icon">
                    <img src="http://localhost/w/logos/logo.png" alt="Profile">
                </div>
                <p>Hello, Admin</p>
            </div>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li class="active">Manage Users</li>
                <li><a href="manageevent.php">Approve Events</a></li>
                <li><a href="inventory.php">Manage Inventory</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
          
            <h2>Users</h2>
          
            <iframe src="users.php" class="iframe-content"></iframe>
           
            <h2>User role requests</h2>
            <iframe src="role_requests.php" class="iframe-content"></iframe>
        </div>
    </div>
</body>
</html>
