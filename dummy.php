<?php if (!empty($message['user_msg'])): ?>
    <div class="<?php echo $userData['usertype'] == 0 ? 'user-message' : 'admin-reply'; ?>">
        <?php echo htmlspecialchars($message['user_msg']); ?>
    </div>
<?php endif; ?>
<?php if (!empty($message['admin_msg'])): ?>
    <div class="<?php echo $userData['usertype'] == 0 ? 'admin-reply' : 'user-message'; ?>">
        <?php echo htmlspecialchars($message['admin_msg']); ?>
    </div>
<?php endif; ?>



<input type="hidden" name="no" value="<?php echo htmlspecialchars($chats[0]['no'] ?? ''); ?>">






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Requests</title>
    <link rel="stylesheet" href="./css/staffstyles.css">
    <script>
        function ShowRejectionReason(button) {
            var row = button.closest('tr');
            var reasonCell = row.querySelector('.reason');

            // Create a form dynamically
            reasonCell.innerHTML = `
                <form action="rejectevent" method="post">
                    <input type="hidden" name="no" value="${row.querySelector('input[name="no"]').value}">
                    <textarea name="reason" placeholder="Reason for rejection" rows="3" required></textarea>
                    <button type="submit" class="reject">Confirm Reject</button>
                </form>
            `;
        }

    </script>
</head>
<body>
    <div class="main">
        <div class="topic">
            <h2>Event Requests</h2>
            <div class="icons">
            <img src="images/searchicon.png" alt="search" style="width:20px">
            <input type="text" id="searchBar" class="searchbar" placeholder="Search events...">
            <input type="text" id="searchBar2" class="searchbar" placeholder="Search events...">
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
        <div class="tb">
            <div class="table-header">
                <table>
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Organization</th>
                            <th>Organizer</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Accept</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr class="data">
                                <td><a href="eventd.php?no=<?= $event['no'] ?>" data-event-type="<?php echo strtolower($event['event_type']); ?>" data-event-date="<?php echo strtolower($event['date']); ?>" ><?= $event['name'] ?></a></td>
                                <td><?= $event['orgname'] ?></td>
                                <td><?= $event['fname']." ".$event['lname'] ?></td>
                                <td class="asd"><?= $event['location'] ?></td>
                                <td><?= $event['date'] ?></td>
                                <td class="t"><?= $event['time'] ?></td>
                                <td>
                                    <form action="acceptevent" method="post">
                                        <input type="hidden" name="no" value="<?= $event['no'] ?>">
                                        <button type="submit" class="accept">Accept</button>
                                    </form>
                                </td>
                                <td class="reason">
                                    <button class="reject" onclick="ShowRejectionReason(this)">Reject</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


<script>
    const searchBar = document.getElementById('searchBar');
    const searchBar2 = document.getElementById('searchBar2');
    const typeFilter = document.getElementById('typeFilter');
    const dateFilter = document.getElementById('dateFilter');
    const cards = document.querySelectorAll('.data');

    let timeout = null;

    function filterEvents() {
            const filter = searchBar.value.toLowerCase();  
            const filter2 = searchBar2.value.toLowerCase();  
            const selectedType = typeFilter.value.toLowerCase();
            const selectedDate = dateFilter.value;

            cards.forEach(card => {
                const eventName = card.querySelector('.t')?.textContent.toLowerCase() || ''; 
                const eventName2 = card.querySelector('.asd')?.textContent.toLowerCase() || '';
                const eventType = card.querySelector('a')?.getAttribute('data-event-type') || '';
                const eventDate = card.querySelector('a')?.getAttribute('data-event-date') || '';

                const matchesSearch = eventName.includes(filter);
                const matchesSearch2 = eventName2.includes(filter2);
                const matchesType = !selectedType || eventType.includes(selectedType);
                const matchesDate = !selectedDate || eventDate === selectedDate;

                if (matchesSearch && matchesType && matchesDate && matchesSearch2) {
                    card.style.display = ''; 
                } else {
                    card.style.display = 'none'; 
                }
            });
        }

    searchBar.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(filterEvents, 500);
    }

);
searchBar2.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(filterEvents, 500);
    }

);


    typeFilter.addEventListener('change', filterEvents);
    dateFilter.addEventListener('change', filterEvents);
    </script>
