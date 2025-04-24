<?php
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$upevent = isset($_SESSION['upevent']) ? $_SESSION['upevent'] : 'NO';

if ($upevent === null) {
    $_SESSION['upevent'] = 'NO'; 
} else { 
    $_SESSION['upevent'] = 'YES'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/indexstyle.css">
    <title>EMS System</title>
</head>
<body>
<?php $deletemessage = isset($_GET['deletemessage']) ? $_GET['deletemessage'] : ""; ?>
<?php if($deletemessage != ""){ ?>
    <div class="banner-message">
        <p><?php echo $deletemessage; ?></p>
    </div>
<?php } ?>

    <div class="box">
        <div class="sliding-panel">
            <div class="panel-content">
                <?php
                $latestEvents = array_slice($events, 0, 8);

                foreach ($latestEvents as $event) {
                    echo '<div class="event">';
                    echo '<a href="event.php?no=' . $event['no'] . '">';
                    echo '<img src="' . $event['event_banner'] . '" alt="Event Image">';
                    echo '<div class="event-details">';
                    echo '<h4>' . $event['name'] . '</h4>';
                    echo '<p>Event Date: ' . $event['date'] . '</p>';
                    echo '<p>Location: ' . $event['location'] . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <main>
        <?php include 'main.php'; ?>
    </main>

    <?php if($username != "Guest" && $upevent != "NO"){ ?>
        <aside class="rside" id="rside">
            <?php include 'upcoming.php'; ?>
        </aside>
    <?php } else { ?>
        <style>
            main {
                width: 100%;
            }
        </style>
    <?php } ?>
</body>
</html>


