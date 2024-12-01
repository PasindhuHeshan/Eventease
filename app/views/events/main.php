<!DOCTYPE html>
<?php
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="./css/mainstyle.css">
</head>

<body class="mainbody">
    
    <div class="topics">
        Events
        <div class="icons">
            <img src="images/searchicon.png" alt="search" style="width:20px">
            <form>
                <select>
                    <option value="option1">Date</option>
                    <option value="option2">Event type</option>
                </select>
            </form>
        </div>
    </div>
    <div class="card-container">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $data): ?>
                <a href="event.php?no=<?php echo $data['no']; ?>">
                    <div class="card">
                        <h2><?php echo $data['name']; ?></h2>
                        <hr>
                        <p><?php echo $data['short_dis']; ?></p>
                        <p>
                            Time: <?php echo $data['time']; ?>
                            <br>
                            Date: <?php echo $data['date']; ?>
                            <br>
                            Location: <?php echo $data['location']; ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</body>
</html>