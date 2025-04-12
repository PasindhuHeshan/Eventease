<link rel="stylesheet" type="text/css" href="./css/aside.css">
<aside class="sidebar">
    <div class="profile-section">
        <div class="profile-icon">
            <img src="<?php echo $adminData['profile_picture']; ?>" alt="Profile Picture">
        </div>
        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
    </div>
    <ul>
        <li class="<?php echo ($parameter == 'dashboard') ? 'active' : ''; ?>"><a href="dashboard.php">Dashboard</a></li>
        <li class="<?php echo ($parameter == 'manage_users') ? 'active' : ''; ?>"><a href="manage_users.php">Manage Users</a></li>
        <li class="<?php echo ($parameter == 'role_requests') ? 'active' : ''; ?>"><a href="role_requests.php">User Privilege Requests</a></li>
        <li class="<?php echo ($parameter == 'manageevent') ? 'active' : ''; ?>"><a href="manageevent.php">Approve Events</a></li>
        <li class="<?php echo ($parameter == 'inventory') ? 'active' : ''; ?>"><a href="inventory.php">Manage Inventory</a></li>
        <li class="<?php echo ($parameter == 'disableacc') ? 'active' : ''; ?>"><a href="disableacc.php">Disabled Accounts</a></li>
        <li class="<?php echo ($parameter == 'feedback') ? 'active' : ''; ?>"><a href="feedback.php">Feedbacks</a></li>
    </ul>
</aside>
