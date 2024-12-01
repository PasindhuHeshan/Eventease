<?php
$inventory_type = isset($_POST['inventory_type']) ? $_POST['inventory_type'] : 'Appliances';  // Default to 'Appliances'
$result = $dashboard->getInventoryByType($inventory_type);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
    <link rel="stylesheet" href="./css/inventorystyles.css">
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
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="manageevent.php">Approve Events</a></li>
                <li class="active">Manage Inventory</li>
            </ul>
        </div>

        <div class="content">
            <h2>Manage Inventory</h2>
            <form method="POST" action="inventory.php" id="inventoryForm">
                <label for="inventory_type">Inventory Type</label>
                <select name="inventory_type" class="inventory_type" onchange="document.getElementById('inventoryForm').submit();">
                    <option value="Appliances" <?php echo $inventory_type == 'Appliances' ? 'selected' : ''; ?>>Appliances</option>
                    <option value="Stationery" <?php echo $inventory_type == 'Stationery' ? 'selected' : ''; ?>>Stationery</option>
                    <option value="Furniture" <?php echo $inventory_type == 'Furniture' ? 'selected' : ''; ?>>Furniture</option>
                    <option value="Electronics" <?php echo $inventory_type == 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
                </select>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Inventory No</th>
                        <th>Quantity</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        use App\Models\Dashboard;
                        use App\Database;

                        $database = new Database();
                        $dashboard = new Dashboard($database);

                        // Check if 'inventory_type' is set, otherwise default to 'Appliances'
                        $inventory_type = isset($_POST['inventory_type']) ? $_POST['inventory_type'] : 'Appliances';

                        // Fetch inventory data
                        $result = $dashboard->getInventoryByType($inventory_type);

                        // Check if any rows were returned
                        if ($result->num_rows > 0) {
                            $no = 1;
                            // Fetch and display each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>$no</td>
                                        <td>{$row['item']}</td>
                                        <td>{$row['inventory_no']}</td>
                                        <td>{$row['quantity']}</td>
                                        <td><form method='POST' action='get_item.php'>
                                            <input type='hidden' name='inventory_no' value='{$row['inventory_no']}'>
                                            <input type='hidden' name='inventory_type' value='{$row['inventory_type']}'>
                                            <button type='submit'>Modify</button>
                                        </form>
                                        </td>";
                                if ($row['in_use'] == 0) {
                                    echo "<td><form method='POST' action='delete_item.php' onsubmit='return confirmDelete()'>
                                            <input type='hidden' name='inventory_no' value='{$row['inventory_no']}'>
                                            <input type='hidden' name='inventory_type' value='{$row['inventory_type']}'>
                                            <button type='submit'>Delete</button>
                                        </form></td>";
                                } else {
                                    echo "<td>Item is in use!</td>";
                                }
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No data found</td></tr>";
                        }
                        ?>
                </tbody>
            </table>
            <form method="POST" action="add_item.php">
                <button type="submit">Add New</button>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    function confirmDelete() {
        // Display a confirmation dialog
        var result = confirm("Are you sure you want to delete this item?");
        
        // If the user clicks 'OK', return true to allow the form submission
        if (result) {
            return true;
        }
        // If the user clicks 'Cancel', prevent the form submission
        else {
            return false;
        }
    }
</script>
