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
                    <?php if ($event['flag'] == 0 && $userdata['role_name'] == "Guest"): ?>
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
                    
                    <div class="cover">
                        <img src="images/events/event.png" alt="Event Cover" class="cover-img">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
