<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        button {
            padding: 5px 10px;
            width: 80px;
            border-radius: 10px;
            background-color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: skyblue;
            color: white;
        }
    </style>
</head>
<body>
    <form method="GET" action="">
        <label for="user_type">User type</label>
        <select name="usertype" id="user_type" onchange="this.form.submit()">
        <option value="staff" <?php if (isset($_GET['usertype']) && $_GET['usertype'] == 'staff') echo 'selected'; ?>>staff</option>
            <option value="admin" <?php if (isset($_GET['usertype']) && $_GET['usertype'] == 'admin') echo 'selected'; ?>>admin</option>
            <option value="guest" <?php if (isset($_GET['usertype']) && $_GET['usertype'] == 'guest') echo 'selected'; ?>>guest</option>
            <option value="organizer" <?php if (isset($_GET['usertype']) && $_GET['usertype'] == 'organizer') echo 'selected'; ?>>organizer</option>
            <option value="student" <?php if (isset($_GET['usertype']) && $_GET['usertype'] == 'student') echo 'selected'; ?>>student</option>
            <option value="support" <?php if (isset($_GET['usertype']) && $_GET['usertype'] == 'support') echo 'selected'; ?>>support</option>
           
        </select>
    </form><br>

    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Disable</th>
        </tr>
        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'eventease');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user type from the form (default to 'staff' if not set)
        $usertype = isset($_GET['usertype']) ? $_GET['usertype'] : 'staff'; // Default to 'staff'

        $usertype = trim($usertype);

        // Make sure we use the right format for string comparison
        $sql = "SELECT No, username, email FROM users WHERE TRIM(usertype) = ?";
        $stmt = $conn->prepare($sql); // Use prepared statement to avoid SQL injection
        $stmt->bind_param("s", $usertype); // Bind the parameter as a string

        // Execute query and check for results
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['No'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td><button type='button' onclick='deleteUser(" . $row['No'] . ")'>Disable</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }

        // Close connection
        $stmt->close();
        $conn->close();
        ?>
    </table>

    <!-- Add New button section -->
    <div id="addNewButton" style="display: none;">
        <a href="useradd.php">
            <button type="button">Add New</button>
        </a>
    </div>

    <script>
        // Function to control visibility of the Add New button
        function toggleAddNewButton() {
            var userType = document.getElementById('user_type').value;
            var addButtonDiv = document.getElementById('addNewButton');
            
            if (userType === 'staff') {
                addButtonDiv.style.display = 'block'; // Show button
            } else {
                addButtonDiv.style.display = 'none'; // Hide button
            }
        }
        window.onload = function() {
            toggleAddNewButton(); // Make sure button is correctly displayed on page load
        };

        // Ensure button visibility is updated when the dropdown changes
        document.getElementById('user_type').addEventListener('change', toggleAddNewButton);
    </script>
</body>
</html>
