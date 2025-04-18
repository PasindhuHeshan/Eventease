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
        <h2> Inventory Requested</h2>
        
        <?php if ($events): ?>
            <!-- Displaying Event Name and Description if found -->
            <div class="event-details">
                <label class="event-label">Event name:</label>
                <div class="event-name"><?php echo htmlspecialchars($events['name']); ?></div>
            </div
            <div class="event-details">
                <label class="event-label">Inventory requested:</label>
                <div class="event-name"><?php echo htmlspecialchars($events['name']); ?></div>
            </div>
            <div class="event-details">
                <label class="event-label">Inventory in use:</label>
                <div class="event-name"><?php echo htmlspecialchars($events['name']); ?></div>
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
            <button class="delete-btn">Reject</button>
        </div>
    </div>
</body>
</html>
