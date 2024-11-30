<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="global.css">
</head>
<body>
<div class="page">
    <h2>My Events</h2>
    <div class="events">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <a href="createform?no=<?php echo $event['no']; ?>">
                <div class="event">
                    <div class="event-image">
                        <img src="<?php echo $event['event_banner']; ?>" alt="Event Banner">
                    </div>
                    <div class="event-details">
                        <h3 class="event-title"><?php echo $event['name']; ?></h3>
                        <p class="event-date">Date: <?php echo $event['date']; ?></p>
                        <p class="event-time">Time: <?php echo $event['time']; ?></p>
                        <p class="event-location">Location: <?php echo $event['location']; ?></p>
                        <p class="event-description"><?php echo $event['short_dis']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
        <div class="create-event">
            <a href="createform"><button type="button" class="btn primary">Create Event</button></a>
        </div>
    </div>
</div>
</body>
</html>
