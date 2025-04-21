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
                <label class="event-label">Event name</label>
                <div class="event-name"><?php echo $event['name']; ?></div>
            </div>
            <div class="event-details">
                <label class="event-label">Organizer</label>
                <div class="event-name"><?php echo $event['fname']. " " . $event['lname']; ?></div>
            </div>
            <div class="event-details">
                <label class="event-label">Contact Number</label>
                <div class="event-name"><?php echo $event['contact_number']; ?></div>
            </div>
            <div class="event-details">
                <label class="event-label">Inventory requested</label>
                <div class="event-name"><?php echo $event['item']; ?></div>
            </div>
            <div class="event-details">
                <label class="event-label">Quantity Requested</label>
                <div class="event-name"><?php echo $event['Qty']; ?></div>
            </div>
            <div class="event-details">
                <label class="event-label">Available Quantity</label>
                <div class="event-name"><?php echo $availability; ?></div>
            </div>
            
            <div class="event-buttons">
                <form action="handleinventory" method="post">
                <?php if($availability>=$event['Qty']):?>
                        <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                        <input type="hidden" name="inventory_item" value="<?php echo $event['inventory_item']; ?>">
                        <input type="hidden" name="quantity" value="<?php echo $event['quantity']; ?>">
                        <button type="submit" name="approve" class="approve-btn">Approve</button>
                <?php endif; ?>
                    <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                    <input type="hidden" name="inventory_item" value="<?php echo $event['inventory_item']; ?>">
                    <button type="submit" name="reject" class="delete-btn">Reject</button>
                </form>
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
