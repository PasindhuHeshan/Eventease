<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Events</title>
    <link rel="stylesheet" href="./css/mngeventstyles.css">
</head>
<body>
<header>
        <p>Hello</p>
        <div class="header-right">
            <span>, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <form method="POST" action="adminlogout.php" class="form">
                <button type="submit" class="logout-button">Log out</button>
            </form>
        </div>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-icon">
                <img src="./images/adminlogo.png" alt="Profile">
                </div>
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>
            <ul>
                
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li class="active">Approve Events</li>
                <li><a href="inventory.php">Manage Inventory</a></li>
            </ul>
        </div>

        <div class="content">
            <iframe src="events.php" class="iframe-section"></iframe>
            <iframe src="approved_events.php" class="iframe-section"></iframe>
        </div>
    </div>
</body>
</html>
