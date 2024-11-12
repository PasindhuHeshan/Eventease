<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboardstyle.css">
</head>
<body>
    <header>
        <p>Hello</p>
        <div class="header-right">
            <span>, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <form method="POST" action="logout.php">
                <button type="submit" class="logout-button">Log out</button>
            </form>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <div class="profile-section">
                <div class="profile-icon">
                    <img src="http://localhost/w/logos/adminlogo.png" alt="Profile">
                </div>
                <span>Hello, Admin</span>
            </div>
            <ul>
                <li class="active">Dashboard</li>
                <li><a href="../users/manage users.php">Manage Users</a></li>
                <li><a href="../events/manageevent.php">Approve Events</a></li>
                <li><a href="../inventory/inventory.php">Manage Inventory</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <!-- User Type Section -->
            <div class="card">
                <h3>User Type</h3>
                <select name="user_type" form="filter-form">
                    <option value="staff" <?php if(isset($user_type) && $user_type == 'staff') echo 'selected'; ?>>Staff Member</option>
                    <option value="organizers" <?php if(isset($user_type) && $user_type == 'organizers') echo 'selected'; ?>>Event Organizers</option>
                </select>
                <p>Users: <?php echo $user_count; ?></p>
            </div>

            <!-- Event Type Section -->
            <div class="card">
                <h3>Event Type</h3>
                <select name="event_type" form="filter-form">
                    <option value="Social" <?php if(isset($event_type) && $event_type == 'Social') echo 'selected'; ?>>Social</option>
                    <option value="Educational" <?php if(isset($event_type) && $event_type == 'Educational') echo 'selected'; ?>>Educational</option>
                    <option value="Entertainment" <?php if(isset($event_type) && $event_type == 'Entertainment') echo 'selected'; ?>>Entertainment</option>
                    <option value="Culture" <?php if(isset($event_type) && $event_type == 'Culture') echo 'selected'; ?>>Culture</option>
                    <option value="Charity" <?php if(isset($event_type) && $event_type == 'Charity') echo 'selected'; ?>>Charity</option>
                    <option value="Music" <?php if(isset($event_type) && $event_type == 'Music') echo 'selected'; ?>>Music</option>
                </select>
                <p id="event_count">Events: <?php echo $event_count; ?></p>
            </div>

            <!-- Inventory Section -->
            <div class="card">
                <h3>Inventory</h3>
                <form id="inventory-form" method="POST" action="">
                    <select name="inventory_type" onchange="this.form.submit()">
                        <option value="Appliances" <?php if(isset($inventory_type) && $inventory_type == 'Appliances') echo 'selected'; ?>>Appliances</option>
                        <option value="Stationery" <?php if(isset($inventory_type) && $inventory_type == 'Stationery') echo 'selected'; ?>>Stationery</option>
                        <option value="Furniture" <?php if(isset($inventory_type) && $inventory_type == 'Furniture') echo 'selected'; ?>>Furniture</option>
                        <option value="Electronics" <?php if(isset($inventory_type) && $inventory_type == 'Electronics') echo 'selected'; ?>>Electronics</option>
                    </select>
                </form>
                <p>Inventories: <?php echo $inventory_count; ?></p>
            </div>
        </main>
    </div>
</body>
</html>
