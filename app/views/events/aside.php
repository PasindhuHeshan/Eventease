<link rel="stylesheet" type="text/css" href="./css/aside.css">
<aside class="sidebar">
    <div class="profile-section">
        <div class="profile-icon">
            <img src="./images/adminlogo.png" alt="Profile">
        </div>
        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
    </div>
    <ul>
        <li class="<?php echo ($parameter == 'dashboard') ? 'active' : ''; ?>"><a href="dashboard.php">Dashboard</a></li>
        <li class="<?php echo ($parameter == 'manage_users') ? 'active' : ''; ?>"><a href="manage_users.php">Manage Users</a></li>
        <li class="<?php echo ($parameter == 'role_requests') ? 'active' : ''; ?>"><a href="role_requests.php">User Privilege Requests</a></li>
        <li class="<?php echo ($parameter == 'manageevent') ? 'active' : ''; ?>"><a href="manageevent.php">Approve Events</a></li>
        <li class="<?php echo ($parameter == 'inventory') ? 'active' : ''; ?>"><a href="inventory.php">Manage Inventory</a></li>
    </ul>
</aside>
