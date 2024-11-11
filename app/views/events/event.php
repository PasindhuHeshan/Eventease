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
                    <hr>
                    <p class="details"><?php echo $event['long_dis']; ?></p>
                    <p><b>
                        Time: <?php echo $event['time']; ?>
                        <br>
                        Location: <?php echo $event['location']; ?>
                    </b></p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
