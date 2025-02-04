<?php
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$upevent = isset($_SESSION['upevent']) ? $_SESSION['upevent'] : 'NO';

if ($upevents === null) {
    $_SESSION['upevent'] = 'NO'; 
} else { 
    $_SESSION['upevent'] = 'YES'; 
}
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="./css/indexstyle.css">
    <title>EMS System</title>
</head>
<body>
    <div class="box">
    <div class="sliding-panel">
        <div class="panel-content">
            <?php
            $latestEvents = array_slice($events, 0, 8);

            foreach ($latestEvents as $event) {
                echo '<div class="event">';
                echo '<img src="' . $event['event_banner'] . '" alt="Event Image">';
                echo '<div class="event-details">';
                echo '<h3>' . $event['name'] . '</h3>';
                echo '<p>Event Date: ' . $event['date'] . '</p>';
                echo '<p>Location: ' . $event['location'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    </div>

    <main>
        <?php include 'main.php'; ?>
    </main>
    <?php if($username!="Guest" && $upevent!="NO"){?>
    <aside class="rside" id="rside">
        <?php include 'upcoming.php'; ?>
    </aside>
    <?php } else { ?>
        <style>
            main {
                width: 100%;
            }
        </style>
    <?php }?>
</body>
</html>
<!-- <script>
    const panelContent = document.querySelector('.panel-content');
    let autoSlideInterval;

    function slidePanel() {
        panelContent.classList.toggle('slide-right');
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            slidePanel();
        }, 10000); // 10 seconds
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    function showTooltip(event) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.innerHTML = `
            <p>Event Name: ${event.target.alt}</p>
            <p>Time: 10:00 AM</p>
            <p>Date: 2024-01-15</p>
            <p>Location: Art Gallery</p>
        `;
        document.body.appendChild(tooltip);
        tooltip.style.left = `${event.pageX}px`;
        tooltip.style.top = `${event.pageY}px`;
    }

    function hideTooltip() {
        const tooltip = document.querySelector('.tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }


    panelContent.addEventListener('mouseenter', stopAutoSlide);
    panelContent.addEventListener('mouseleave', startAutoSlide);
    panelContent.addEventListener('mouseover', showTooltip);
    panelContent.addEventListener('mouseout', hideTooltip);

    // Start the auto slide when the page loads
    startAutoSlide();

</script> -->
<script>
    const panelContent = document.querySelector('.panel-content');
    let autoSlideInterval;

    function slidePanel() {
        panelContent.classList.toggle('slide-right');
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            slidePanel();
        }, 10000); // 10 seconds
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    function cloneEvents() {
    const events = panelContent.querySelectorAll('.event');
    events.forEach(event => {
        const clone = event.cloneNode(true);
        panelContent.appendChild(clone);
    });
    }


    function showTooltip(event) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.innerHTML = `
            <p>Event Name: ${event.target.alt}</p>
            <p>Time: 10:00 AM</p>
            <p>Date: 2024-01-15</p>
            <p>Location: Art Gallery</p>
        `;
        document.body.appendChild(tooltip);
        tooltip.style.left = `${event.pageX}px`;
        tooltip.style.top = `${event.pageY}px`;
    }

    function hideTooltip() {
        const tooltip = document.querySelector('.tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }

    panelContent.addEventListener('mouseenter', stopAutoSlide);
    panelContent.addEventListener('mouseleave', startAutoSlide);
    panelContent.addEventListener('mouseover', showTooltip);
    panelContent.addEventListener('mouseout', hideTooltip);

    // Clone images to create an infinite loop
    cloneEvents();

    // Start the auto slide when the page loads
    startAutoSlide();

</script>