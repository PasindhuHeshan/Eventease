<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/event.css">
</head>
<body>
    <main class="main">
        <div>
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
                    <?php if (!$isEnrolled): ?>
                        <?php if ($event['flag'] == 0 && $userdata['usertype'] == "guest"): ?>
                            <!-- Do not show enroll button for guests if flag is 0 -->
                        <?php else: ?>
                            <form action="enroll.php" method="POST"> 
                                <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                                <button type="submit" id="enroll">Enroll</button> 
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <form action="removeEnrollment.php" method="POST" onsubmit="confirmUnenroll()"> 
                            <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                            <button type="submit" id="removeenroll">Remove Enroll</button> 
                        </form>
                    <?php endif; ?>
                    <div class="cover">
                        <?php if (!empty($event['event_banner'])): ?>
                            <img src="<?php echo $event['event_banner']; ?>" alt="Event Cover" class="cover-img">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
<script type="text/javascript"> 
    function confirmUnenroll() { 
        return confirm("Are you sure you want to unenroll from this event?"); 
    }
</script>