
<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventease";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events where approvedstatus = 1
$sql = "SELECT no, name FROM events WHERE approvedstatus = 0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Events</title>
    <link rel="stylesheet" href="./css/mngeventstyles.css">
</head>
<body>
    <h2>Approved Events</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>View</th>
                <th>Reject</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any events
            if ($result->num_rows > 0) {
                // Loop through the events and display them in the table
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['no'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td><a href='approvedeventview.php?event_no=" . $row['no'] . "'><button>View</button></a></td>";
                    echo "<td><button>Reject</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No approved events found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
