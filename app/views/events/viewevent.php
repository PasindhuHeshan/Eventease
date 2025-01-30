
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

// Get the event ID from the URL query parameter (e.g., 1.php?event_no=1)
$eventId = isset($_GET['event_no']) ? (int)$_GET['event_no'] : 0;

// Fetch event data based on event ID where approvedstatus = 0 (unapproved events)
$sql = "SELECT name, long_dis FROM events WHERE no = ? AND approvedstatus = 1"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $eventId); 
$stmt->execute();
$result = $stmt->get_result();

$eventData = null;

if ($result->num_rows > 0) {
    // Fetch the event data from the result
    $eventData = $result->fetch_assoc();
} else {
   
    echo "No unapproved event found with the specified ID.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Events</title>
    <link rel="stylesheet" href="./css/eventviewstyle.css">
</head>
<body>
    <div class="event-container">
        <h2> Events</h2>
        
        <?php if ($eventData): ?>
            <!-- Displaying Event Name and Description if found -->
            <div class="event-details">
                <label class="event-label">Event name:</label>
                <div class="event-name"><?php echo htmlspecialchars($eventData['name']); ?></div>
            </div>
            <div class="event-details">
                <label class="event-label">Event description:</label>
                <div class="event-description"><?php echo htmlspecialchars($eventData['long_dis']); ?></div>
            </div>
        <?php else: ?>
            <!-- If no unapproved event is found -->
            <div class="event-details">
                <p>No unapproved event found.</p>
            </div>
        <?php endif; ?>

        <div class="event-buttons">
            <!-- These buttons would need logic to handle approval or rejection -->
            <button class="approve-btn">Approve</button>
            <button class="delete-btn">Delete</button>
        </div>
    </div>
</body>
</html>
