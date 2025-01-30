<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="./css/mainstyle.css">
    <style>
        .card.hide {
            display: none;
        }
    </style>
</head>

<body class="mainbody">
    <div class="topics">
        Events
        <div class="icons">
            <img src="images/searchicon.png" alt="search" style="width:20px">
            <input type="text" id="searchBar" class="searchbar" placeholder="Search events...">
            <form id="filterForm">
                <input type="date" id="dateFilter" class="dateFilter">
                <select id="typeFilter">
                    <option value="">All Types</option>
                    <option value="Social">Social</option>
                    <option value="Educational">Educational</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Culture">Culture</option>
                    <option value="Charity">Charity</option>
                    <option value="Music">Music</option>
                    <option value="Exhibition">Exhibition</option>
                    <option value="Festival">Festival</option>
                    <option value="Conference">Conference</option>
                    <option value="Event">Event</option>
                    <option value="Expo">Expo</option>
                    <option value="Summit">Summit</option>
                </select>
            </form>
        </div>
    </div>
    <div class="card-container">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $data): ?>
                <a href="event.php?no=<?php echo $data['no']; ?>" class="event-link" data-event-type="<?php echo strtolower($data['event_type']); ?>">
    <div class="card">
        <h2><?php echo $data['name']; ?></h2>
        <hr>
        <p class="description"><?php echo $data['short_dis']; ?></p> <!-- this description is for js to search -->
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

    <script>
    const searchBar = document.getElementById('searchBar');
    const dateFilter = document.getElementById('dateFilter');
    const typeFilter = document.getElementById('typeFilter');
    const cards = document.querySelectorAll('.card');

    let timeout = null;

    function filterEvents() {
        const filter = searchBar.value.toLowerCase();
        const selectedDate = dateFilter.value;
        const selectedType = typeFilter.value.toLowerCase();
        let visibleCards = [];

        cards.forEach(card => {
            const eventName = card.querySelector('h2').textContent.toLowerCase();
            const eventDescription = card.querySelector('.description').textContent.toLowerCase(); // Get description
            const eventDate = card.querySelector('p:nth-child(3)').textContent.split('Date: ')[1]; // Correct index
            const eventType = card.parentElement.getAttribute('data-event-type'); // Get event type from data attribute

            const matchesSearch = eventName.includes(filter) || eventDescription.includes(filter); // Check description too
            const matchesDate = !selectedDate || eventDate === selectedDate;
            const matchesType = !selectedType || eventType.includes(selectedType);

            if (matchesSearch && matchesDate && matchesType) {
                card.classList.remove('hide');
                card.parentElement.style.display = '';
                visibleCards.push(card);
            } else {
                card.classList.add('hide');
                card.parentElement.style.display = 'none';
            }
        });
    }

    searchBar.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(filterEvents, 500);
    });

    dateFilter.addEventListener('change', filterEvents);
    typeFilter.addEventListener('change', filterEvents);
</script>