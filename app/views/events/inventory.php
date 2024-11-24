<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
    <link rel="stylesheet" href="inventorystyles.css">
</head>
<body>
<header>
    <p>Hello, admin</p>
</header>
    <div class="container">
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-icon">
                    <img src="http://localhost/w/logos/logo.png" alt="Profile">
                </div>
                <p>Hello, Admin</p>
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
            <form method="POST" action="inventory.php">
                <label for="inventory_type">Inventory type</label>
                <select name="inventory_type" id="inventory_type">
                    <option value="Appliances">Appliances</option>
                    <option value="Stationery">Stationery</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Electronics">Electronics</option>
                </select>
                <button type="submit">Filter</button>
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
                                            <button type='submit'>Update</button>
                                        </form>
                                        </td>
                                        <td><form method='POST' action='delete_item.php'>
                                            <input type='hidden' name='inventory_no' value='{$row['inventory_no']}'>
                                            <button type='submit'>Delete</button>
                                        </form></td>
                                    </tr>";
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
