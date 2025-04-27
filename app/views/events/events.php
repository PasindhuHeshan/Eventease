<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="./css/mngeventstyles.css">
</head>
<body>

    <h2>Events</h2>
    <p>Here you can allocate inventory for each request.</p>

    <div class="event-type-container">
        <label for="event_type">Event Type</label>
        <select name="event_type" id="event_type">
            <option value="">All</option>
            <?php foreach ($eventtype as $type): ?>
                <option value="<?php echo htmlspecialchars($type['event_type']); ?>">
                    <?php echo htmlspecialchars($type['event_type']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Event Table -->
    <table>
        <thead>
            <!-- php print_r($events); -->
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>View Inventory Requested</th>
            </tr>
        </thead>
      
        <tbody id="events_table_body">
            <?php if (!empty($events) && is_array($events)): ?>
                <?php foreach ($events as $event): ?>
                <tr class="event_row" data-event-type="<?php echo htmlspecialchars($event['event_type']); ?>">
                    <td><?php echo htmlspecialchars($event['no']); ?></td>
                    <td><?php echo htmlspecialchars($event['name']); ?></td>
                    <td><?php echo htmlspecialchars($event['time']); ?></td>
                    <td><?php echo htmlspecialchars($event['finish_time']); ?></td>
                    <td>
                        <form action="adminviewevent" method="post">
                            <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['event_id']); ?>">
                            <input type="hidden" name="inventory_item" value="<?php echo htmlspecialchars($event['inventory_item']); ?>">
                            <button type="submit">View Inventory</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No events available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Script -->
    <script>
    // Filter events by event type
    document.getElementById('event_type').addEventListener('change', function() {
        var selected = this.value.trim().toLowerCase();
        var rows = document.querySelectorAll('.event_row');

        rows.forEach(function(row) {
            var type = row.getAttribute('data-event-type').trim().toLowerCase();
            if (selected === "" || type === selected) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    </script>

</body>
</html>
