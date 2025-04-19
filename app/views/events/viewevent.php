<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Events</title>
    <link rel="stylesheet" href="./css/eventviewstyle.css">
</head>
<body>
    <div class="event-page">
    <h2> Inventory Requested</h2>
    <div class="event-container">
        <?php if ($event): ?>
            <div class="event-details">
                <label class="event-label">Event name:</label>
                <div class="event-name"><?php echo $event['name']; ?></div>
            </div>
            
            <div class="event-details">
                <label class="event-label">Inventory requested:</label>
                <div class="event-name"><?php echo $event['item']; ?></div>
            </div>
            
          //  Add data here
            
            <div class="event-buttons">
                <button class="approve-btn">Approve</button>
                <button class="delete-btn">Reject</button>
            </div>
        <?php else: ?>
            <div class="event-details">
                <p>No unapproved event found.</p>
            </div>
        <?php endif; ?>
    </div>
    </div>
        </div>
</body>
</html>
