
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

// Query to fetch role requests from the 'rolereq' table
$sql = "SELECT no, username, email, role FROM rolereq"; 
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
            $no = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["no"] . "</td> <!-- Displaying the 'no' as the ID -->
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["email"] . "</td>
                         <td>" . $row["role"] . "</td>

                        <td><button onclick='approveRequest(" . $row["no"] . ")'>Approve</button></td>
                        <td><button onclick='deleteRequest(" . $row["no"] . ")'>Reject</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No role requests found.</td></tr>";
        }
        ?>

    </table>

    <script>
        function approveRequest(no) {
            if (confirm("Are you sure you want to approve this request?")) {
                window.location.href = "approve.php?no=" + no; // Redirect to PHP script to handle approval
            }
        }

        function deleteRequest(no) {
            if (confirm("Are you sure you want to delete this request?")) {
                window.location.href = "delete.php?no=" + no; // Redirect to PHP script to handle deletion
            }
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
