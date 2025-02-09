<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/event.css">
    <style>
        .button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .enroll-button {
            background-color: #007bff;
            color: white;
        }
        .enroll-button.disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        .remove-enroll-button {
            background-color: #28a745;
            color: white;
        }
        .remove-enroll-button.disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        .main {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .event-details {
            flex: 1;
            margin-right: 20px;
        }
        .cover {
            flex: 0 0 500px;
        }
        .cover-img {
            max-width: 100%;
            height: auto;
        }
        .notice {
            color: red;
            font-size: smaller;
        }
    </style>
</head>
<body>
    <main class="main">
        <div class="event-details">
            <?php if ($event): ?>
                <div>
                    <h1><?php echo $event['name']; ?></h1>
                    <?php if ($event['flag'] == 0 && $userdata['usertype'] == "guest"): ?>
                        <p style="font-weight: bold; font-size: smaller; color:red;">*This Event is Only Available for <u>University Students</u></p>
                    <?php endif; ?>
                    <hr>
                    <p class="details"><?php echo $event['long_dis']; ?></p>
                    <p><b>
                        Time: <?php echo $event['time']; ?>
                        <br>
                        Date: <?php echo $event['date']; ?>
                        <br>
                        Location: <?php echo $event['location']; ?>
                    </b></p>
                    <?php
                    $eventDate = new DateTime($event['date']);
                    $currentDate = new DateTime();
                    $interval = $currentDate->diff($eventDate);
                    $daysUntilEvent = $interval->days;
                    ?>
                    <?php if (!$isEnrolled): ?>
                        <?php if ($event['flag'] == 0 && $userdata['usertype'] == "guest"): ?>
                            <!-- Do not show enroll button for guests if flag is 0 -->
                        <?php else: ?>
                            <form action="enroll.php" method="POST"> 
                                <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                                <button type="submit" class="button enroll-button<?php echo ($daysUntilEvent <= 5) ? ' disabled' : ''; ?>" <?php echo ($daysUntilEvent <= 5) ? 'disabled' : ''; ?>>Enroll</button>
                                <?php if ($daysUntilEvent <= 5): ?>
                                    <p class="notice">*Enroll Closed.</p>
                                <?php endif; ?>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <form action="removeEnrollment.php" method="POST" onsubmit="return confirmUnenroll(<?php echo $daysUntilEvent; ?>)"> 
                            <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                            <button type="submit" class="button remove-enroll-button<?php echo ($daysUntilEvent <= 7) ? ' disabled' : ''; ?>" <?php echo ($daysUntilEvent <= 7) ? 'disabled' : ''; ?>>Enrolled</button> 
                        </form>
                        <?php if ($daysUntilEvent <= 7): ?>
                            <p class="notice">*You cannot unenroll from this event as it is within the next 7 days.</p>
                        <?php else: ?>
                            <p class="notice">*You can unenroll from this event only before the last 7 days.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="cover">
            <?php if (!empty($event['event_banner'])): ?>
                <img src="<?php echo $event['event_banner']; ?>" alt="Event Cover" class="cover-img">
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
<script type="text/javascript"> 
    function confirmUnenroll(daysUntilEvent) { 
        if (daysUntilEvent <= 7) {
            alert("You cannot unenroll from this event as it is within the next 7 days.");
            return false;
        }
        return confirm("Are you sure you want to unenroll from this event?");
    }
</script>