<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
</head>
<body>
<div class="page">
    <h2>My Events</h2>
    <div class="events">
        <?php if (!empty($orgevents)): ?>
            <?php foreach ($orgevents as $event): ?>
                <?php
                    $userType = $userData['usertype']; // Assuming userData contains the user type
                    $eventLink = '';

                    if ($userType == '3') {
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
                            <?php if($userType=='3'&& $event['approvedstatus']!=1 && ($event['organizer']==$userData['No'])){ echo '<a href="addmore?no=' . $event['no'] . '">Edit Event</a>';} ?>
                        </p>
                        <p class="event-description"><?php if(($userType=='1')||($userType=='3')){ echo '<a href="inquiry?no=' . $event['no'] . '">Inquiries</a>';} ?></p>
                        <p class="event-description"><?php if(($userType=='1')||($userType=='3')){ echo '<a href="enrollment?no=' . $event['no'] . '">Enrollment</a>';} ?></p>
                        <p class="event-description"><?php if(($userType=='1')||($userType=='3')){ echo '<a href="review?no=' . $event['no'] . '">Review</a>';} ?></p>
                        <p class="event-description"><?php if(($userType=='1')||($userType=='3')){ echo '<a href="statistics?no=' . $event['no'] . '">Statistics</a>';} ?></p>
                        <p class="event-description"><?php if(($userType=='1')||($userType=='3')){ echo '<a href="report?no=' . $event['no'] . '">Report</a>';} ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
        <?php 
        $userType = $userData['usertype'];
        if ($userType == '3'){?>
        <div class="create-event">
            <a href="createform"><button type="button" class="btn primary">Create Event</button></a>
        </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
