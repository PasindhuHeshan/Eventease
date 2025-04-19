<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
</head>
<body>
<div class="page">
    <h2>My Events</h2>
    <div class="events">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <?php
                    $userType = $userData['usertype']; // Assuming userData contains the user type
                    $eventLink = '';

                    if ($userType == 'organizer') {
                        $eventLink = 'createform?no=' . $event['no'];
                    } else {
                        $eventLink = 'enrollmentform';
                    }
                ?>
                <!-- <a href="<?php echo $eventLink; ?>"> -->

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
                        <?php if($event['approvedstatus']==1){ echo '<p class="event-description" style="color:red; font-weight:bold;">Waiting for approval</p>';} ?>
                        <?php if($event['approvedstatus']==2){ echo '<p class="event-description" style="color:red; font-weight:bold;">Event Rejected</p>';} ?>
                        <hr>
                        <p class="event-description">
                            <?php if($userType=='organizer'){ echo '<a href="createform?no=' . $event['no'] . '">Edit Event</a>';} ?>
                        </p>
                        <p class="event-description"><?php if($userType=='support'){ echo '<a href="inquiry">Inquries</a>';} ?></p>
                        <p class="event-description"><?php if($userType=='support'){ echo '<a href="enrollment">Enrollment</a>';} ?></p>
                        <p class="event-description"><?php if($userType=='support'){ echo '<a href="review">Review</a>';} ?></p>
                        <p class="event-description"><?php if($userType=='support'){ echo '<a href="statistics">Statistics</a>';} ?></p>
                        <p class="event-description"><?php if($userType=='support'){ echo '<a href="report">Report</a>';} ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
        <?php 
        $userType = $userData['usertype'];
        if ($userType == 'organizer'){?>
        <div class="create-event">
            <a href="createform"><button type="button" class="btn primary">Create Event</button></a>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
