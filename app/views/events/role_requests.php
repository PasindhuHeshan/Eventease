<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventease"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle approval or rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $no = $_POST['no'];
        
        // Fetch the requested role details from the 'rolereq' table
        $sql = "SELECT username, role FROM rolereq WHERE no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $no);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $role = $row['role'];

            // Update the status of the role request to 1 (approved)
            $updateRolereq = "UPDATE rolereq SET status = 1 WHERE no = ?";
            $stmt2 = $conn->prepare($updateRolereq);
            $stmt2->bind_param("i", $no);
            $stmt2->execute();

            // Update the user's role in the 'users' table
            $updateUser = "UPDATE users SET usertype = ? WHERE username = ?";
            $stmt3 = $conn->prepare($updateUser);
            $stmt3->bind_param("ss", $role, $username);
            $stmt3->execute();
        }
    }

    if (isset($_POST['reject'])) {
        $no = $_POST['no'];

        // Update the status to -1 (rejected) instead of deleting the row
        $updateRolereq = "UPDATE rolereq SET status = -1 WHERE no = ?";
        $stmt2 = $conn->prepare($updateRolereq);
        $stmt2->bind_param("i", $no);
        $stmt2->execute();
    }

    // Redirect to the same page after approval or rejection
    header("Location: role_requests.php");
    exit();
}

// Query to fetch role requests from the 'rolereq' table, filtering out the approved (status = 1) and rejected (status = -1) ones
$sql = "SELECT no, username, email, role FROM rolereq WHERE status = 0"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Requested Role</th>
            <th>Approve</th>
            <th>Reject</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Output each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["no"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["role"] . "</td>
                        <td>
                            <form method='POST'>
                                <input type='hidden' name='no' value='" . $row["no"] . "'>
                                <button type='submit' name='approve'>Approve</button>
                            </form>
                        </td>
                        <td>
                            <form method='POST'>
                                <input type='hidden' name='no' value='" . $row["no"] . "'>
                                <button type='submit' name='reject'>Reject</button>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No role requests found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
