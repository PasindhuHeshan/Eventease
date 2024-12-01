<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/upcomingstyle.css">
</head>
<body class="mainbody2">
    <div class="topics2">Registed Events</div>
    <div class="card-container2">
        <?php if (!empty($upevents)): ?>
            <?php foreach ($upevents as $data): ?>
                <a href="event.php?no=<?php echo $data['no']; ?>">
                    <div class="card2">
                        <h3><?php echo $data['name']; ?></h3>
                        <hr>
                        <p>
                            Time: <?php echo $data['time']; ?>
                            <br>
                            Date: <?php echo $data['date']; ?>
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