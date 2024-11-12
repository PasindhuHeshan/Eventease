<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require '../inventory/connection.php';

$user_count = 0;
$event_count = 0;
$inventory_count = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Fetch selected user type
    if (isset($_POST['user_type'])) {
        $user_type = $_POST['user_type'];
        $query = "SELECT COUNT(*) AS count FROM users WHERE user_type = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $user_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $user_count = $data['count'];
    }

    // Fetch selected event type
    if (isset($_POST['event_type'])) {
        $event_type = $_POST['event_type'];
        $query = "SELECT COUNT(*) AS count FROM events WHERE event_type = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $event_type);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $event_count = $data['count'];
    }

    // Retrieve and sanitize the inventory_type
    $inventory_type = isset($_POST['inventory_type']) ? $_POST['inventory_type'] : '';

    // Execute the query to get the sum of quantity
    $query = "SELECT SUM(quantity) AS total_quantity FROM inventory WHERE inventory_type = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("s", $inventory_type);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $data = $result->fetch_assoc();
            $inventory_count = $data['total_quantity'] ?? 0;
        } else {
            echo "Error: Could not retrieve result.";
        }
        
        $stmt->close();
    } else {
        echo "Error: Could not prepare statement.";
    }
}
?>

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
                    <option value="A" <?php if(isset($event_type) && $event_type == 'A') echo 'selected'; ?>>A</option>
                    <option value="B" <?php if(isset($event_type) && $event_type == 'B') echo 'selected'; ?>>B</option>
                    <option value="C" <?php if(isset($event_type) && $event_type == 'C') echo 'selected'; ?>>C</option>
                </select>
                <p>Events: <?php echo $event_count; ?></p>
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
