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
    <p>Hello , admin</p>
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
                
                <li><a href="../login and dashboard/dashboard_content.php">Dashboard</a></li>
                <li><a href="../users/manage users.php">Manage Users</a></li>
                <li><a href="../events/manageevent.php">Approve Events</a></li>
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
                        include 'connection.php';

                        // Check if 'inventory_type' is set, otherwise default to 'Appliances'
                        $inventory_type = isset($_POST['inventory_type']) ? $_POST['inventory_type'] : 'Appliances';

                        // Ensure inventory_type is properly quoted for SQL
                        $inventory_type = $con->real_escape_string($inventory_type);  // Sanitizes input for security

                        // Correct the SQL query to quote the inventory_type variable
                        $sql = "SELECT * FROM inventory WHERE inventory_type = '$inventory_type'";

                        // Execute the query
                        $result = $con->query($sql);

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
                                        <td><a href='modify_item.php?id={$row['id']}'><button type='submit'>Modify</button></a></td>
                                        <td><form method='POST' action='delete_item.php'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit'>Delete</button>
                                        </form></td>
                                    </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No data found</td></tr>";
                        }

                        $con->close();
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
