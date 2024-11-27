<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="event.css">
</head>
<body>
    <main class="main">
        <div>
            <?php if ($event): ?>
                <div>
                    <h1><?php echo $event['name']; ?></h1>
                    <?php if($event['flag']==0){ ?>
                        <p style="font-weight: bold; font-size: smaller;">*This Event is Only Available for <u>University Students</u></p>
                    <?php } ?>
                    <hr>
                    <p class="details"><?php echo $event['long_dis']; ?></p>
                    <p><b>
                        Time: <?php echo $event['time']; ?>
                        <br>
                        Date: <?php echo $event['date']; ?>
                        <br>
                        <br>
                        Location: <?php echo $event['location']; ?>
                    </b></p>
                    <?php if (!$isEnrolled):?>
                    <form action="enroll.php" method="POST"> 
                        <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                        <button type="submit" id="enroll">Enroll</button> 
                    </form>
                    <?php else: ?>
                    <form action="removeEnrollment.php" method="POST"> 
                        <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                        <button type="submit" id="removeenroll">Remove Enroll</button> 
                    </form>
                    <?php endif; ?>
                    <div class="cover">
                        <img src="images/events/event.png" alt="Event Cover" class="cover-img">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
