<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/upcomingstyle.css">
</head>
<body class="mainbody2">
    <div class="topics2">Registered Events</div>
    <div class="card-container2">
        <?php if (!empty($upevents)): ?>
            <?php foreach ($upevents as $data): ?>
                <a href="event.php?no=<?php echo $data['no']; ?>">
                    <div class="card2">
                        <h3><?php echo $data['name']; ?></h3>
                        <hr>
                        <p>
                            Start Time: <?php echo $data['time']; ?>
                            <br>
                            Date: <?php echo $data['date']; ?>
                            <br>
                            Venue: <?php echo $data['location']; ?>
                            <br>
                        </p>
                    </div>
                </a>
                <br>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No Registed Events found.</p>
        <?php endif; ?>
        <hr>
        <p>Past Events</p>
        <?php if (!empty($uppastevents)): ?>
            <?php foreach ($uppastevents as $data): ?>
                <a href="event.php?no=<?php echo $data['no']; ?>">
                    <div class="card2">
                        <h3><?php echo $data['name']; ?></h3>
                        <hr>
                        <p><?php if($data['date'] < date('Y-m-d')) { echo "<span style='color:#ff4f4f'>Finished</span><br/>"; } ?>
                            Start Time: <?php echo $data['time']; ?>
                            <br>
                            Date: <?php echo $data['date']; ?>
                            <br>
                            Venue: <?php echo $data['location']; ?>
                            <br>
                        </p>
                    </div>
                </a>
                <br>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No Registed Events found.</p>
        <?php endif; ?>
    </div>
</body>
</html>