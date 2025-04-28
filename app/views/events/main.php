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
                <input type="date" id="dateFilter" class="datefilter" placeholder="Filter by date">
            </form>
        </div>
    </div>
    <div class="card-container">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $data): ?>
                <a href="event.php?no=<?php echo $data['no']; ?>" class="event-link" data-event-type="<?php echo strtolower($data['event_type']); ?>" data-event-date="<?php echo $data['date']; ?>">
                    <div class="card">
                        <h2><?php echo $data['name']; ?></h2>
                        <hr>
                        <p class="description"><?php echo substr($data['long_dis'], 0, 100) . (strlen($data['long_dis']) > 100 ? '...' : ''); ?></p>
                        <p>
                            Start Time: <?php echo $data['time']; ?>
                            <br>
                            Finish Time: <?php echo $data['finish_time']; ?>
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
    const typeFilter = document.getElementById('typeFilter');
    const dateFilter = document.getElementById('dateFilter');
    const cards = document.querySelectorAll('.card');

    let timeout = null;

    function filterEvents() {
        const filter = searchBar.value.toLowerCase();
        const selectedType = typeFilter.value.toLowerCase();
        const selectedDate = dateFilter.value;
        let visibleCards = [];

        cards.forEach(card => {
            const eventName = card.querySelector('h2').textContent.toLowerCase();
            const eventDescription = card.querySelector('.description').textContent.toLowerCase();
            const eventType = card.parentElement.getAttribute('data-event-type');
            const eventDate = card.parentElement.getAttribute('data-event-date');

            const matchesSearch = eventName.includes(filter) || eventDescription.includes(filter);
            const matchesType = !selectedType || eventType.includes(selectedType);
            const matchesDate = !selectedDate || eventDate === selectedDate;

            if (matchesSearch && matchesType && matchesDate) {
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

    typeFilter.addEventListener('change', filterEvents);
    dateFilter.addEventListener('change', filterEvents);
    </script>
</body>
</html>
