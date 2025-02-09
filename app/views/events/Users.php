<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'eventease');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the disable action via a form submission
if (isset($_GET['disable_user'])) {
    $user_id = (int) $_GET['disable_user'];
    $new_status = (int) ($_GET['status'] == 1 ? 0 : 1); // Toggle the status

    // Update the user's status in the database
    $sql = "UPDATE users SET status = ? WHERE No = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_status, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Get user type from the form (default to 'staff' if not set)
$usertype = isset($_GET['usertype']) ? $_GET['usertype'] : 'staff'; // Default to 'staff'
$usertype = trim($usertype);

// Make sure we use the right format for string comparison
$sql = "SELECT No, username, email, status FROM users WHERE TRIM(usertype) = ?";
$stmt = $conn->prepare($sql); // Use prepared statement to avoid SQL injection
$stmt->bind_param("s", $usertype); // Bind the parameter as a string

// Execute query and check for results
$stmt->execute();
$result = $stmt->get_result();
?>

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

        button:disabled {
            background-color: gray;
            cursor: not-allowed;
        }

        #addNewButton {
            margin: 10px 0;
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
            <th>Action(Enable/Disable)</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                // Determine the button text based on user status
                $buttonText = $row['status'] == 1 ? 'Disable' : 'Enable';
                $status = $row['status']; // Save current status for the toggle action
                echo "<tr>";
                echo "<td>" . $row['No'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>
                    <form method='GET' action=''>
                        <input type='hidden' name='usertype' value='$usertype'>
                        <input type='hidden' name='disable_user' value='" . $row['No'] . "'>
                        <input type='hidden' name='status' value='$status'>
                        <button type='submit'>$buttonText</button>
                    </form>
                </td>";
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
    <?php
    // Show "Add New" button only if the user type is 'staff'
    if ($usertype === 'staff') {
        echo '<div id="addNewButton">
                <a href="useradd.php">
                    <button type="button">Add New</button>
                </a>
              </div>';
    }
    ?>
</body>
</html>
