<?php 
    $parameter='event';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/event.css">
</head>
<body>
    <main class="main">
        <div class="event-details">
            <?php if ($event): ?>
                <div>
                    <h1><?php echo $event['name']; ?></h1><h5>Organized by <?php echo $event['orgname'];?></h5>
                    <?php if ($event['flag'] == 0 && $userdata['usertype'] == "2"): ?>
                        <p style="font-weight: bold; font-size: smaller; color:red;">*This Event is Only Available for <u>University Students</u></p>
                    <?php endif; ?>
                    <hr>
                    <p class="details"><?php echo $event['long_dis']; ?></p>
                    <p><b>
                        Start Time: <?php echo $event['time']; ?>
                        <br>
                        Finish Time: <?php echo $event['time']; ?>
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
                    <?php if($event['date']>= date('Y-m-d')):?>
                    <?php if (!$isEnrolled): ?>
                        <?php if ($event['flag'] == 0 && $userdata['usertype'] == "2"): ?>
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
                        <form action="removeEnrollment.php" method="POST" onsubmit="return showModal(<?php echo $daysUntilEvent; ?>)"> 
                            <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                            <button type="submit" class="button remove-enroll-button<?php echo ($daysUntilEvent <= 7) ? ' disabled' : ''; ?>" <?php echo ($daysUntilEvent <= 7) ? 'disabled' : ''; ?>>Enrolled</button> 
                        </form>
                        <br/>
                        <form action="ask.php" method="POST"> 
                            <input type="hidden" name="event_no" value="<?php echo $event['no']; ?>"> 
                            <button type="submit" class="button remove-enroll-button" <?php echo ($daysUntilEvent <= 7) ? 'disabled' : ''; ?>>Inquiries</button> 
                        </form>
                        <?php if ($daysUntilEvent <= 7): ?>
                            <p class="notice">*You cannot unenroll from this event as it is within the next 7 days.</p>
                        <?php else: ?>
                            <p class="notice">*You can unenroll from this event only before the last 7 days.</p>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endif;?>
                </div>
            <?php endif; ?>
        </div>
        <div class="cover">
            <?php if (!empty($event['event_banner'])): ?>
                <img src="<?php echo $event['event_banner']; ?>" alt="Event Cover" class="cover-img">
            <?php endif; ?>
        </div>
    </main>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"></p>
            <button id="confirm-button" class="button">Confirm</button>
            <button id="cancel-button" class="button">Cancel</button>
        </div>
    </div>

    <script type="text/javascript"> 
        function showModal(daysUntilEvent) {
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            var confirmButton = document.getElementById("confirm-button");
            var cancelButton = document.getElementById("cancel-button");
            var message = document.getElementById("modal-message");

            if (daysUntilEvent <= 7) {
                message.textContent = "You cannot unenroll from this event as it is within the next 7 days.";
                confirmButton.style.display = "none";
            } else {
                message.textContent = "Are you sure you want to unenroll from this event?";
                confirmButton.style.display = "inline-block";
            }

            modal.style.display = "block";

            span.onclick = function() {
                modal.style.display = "none";
            }

            cancelButton.onclick = function() {
                modal.style.display = "none";
            }

            confirmButton.onclick = function() {
                modal.style.display = "none";
                document.querySelector("form[action='removeEnrollment.php']").submit();
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            return false;
        }
    </script>
</body>
</html>