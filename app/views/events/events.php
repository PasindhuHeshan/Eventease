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
        <label" for="event_type">Event type</label>
        <select name="event_type" id="event_type">
            <option value="">All</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Conference">Conference</option>
            <option value="Festival">Festival</option>
            <option value="Event">Event</option>
            <option value="Expo">Expo</option>
            <option value="Summit">Summit</option>
            <option value="Charity">Charity</option>
        </select>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>Event Type</th>
                <th>View Inventory Requested</th>
                <th>Action</th>
            </tr>
        </thead>
      
        <tbody id="events_table_body">
            <!-- Events will be populated here dynamically -->
            <?php foreach ($events as $event):?>
                <tr class="event_row" data-event-type="<?php echo $event['event_type']; ?>">
                    <td><?php echo $event['no']; ?></td>
                    <td><?php echo $event['name']; ?></td>
                    <td><?php echo $event['event_type']; ?></td>
                    <td>
                    <button onclick="viewEvent('<?php echo $event['no']; ?>')">View</button>
                    </td>

                    <td>
                        <button>Approve</button> 
                        <button>Reject</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
    // When the event type changes, filter the events
    document.getElementById('event_type').addEventListener('change', function() {
        var selectedEventType = this.value.toLowerCase();
        var rows = document.querySelectorAll('.event_row');
        
        rows.forEach(function(row) {
            var eventType = row.getAttribute('data-event-type').toLowerCase();
            
            if (selectedEventType === "" || eventType.includes(selectedEventType)) {
                row.style.display = ""; // Show the row
            } else {
                row.style.display = "none"; // Hide the row
            }
        });
    });

   
    function viewEvent(eventNo) {
        window.location.href = "viewevent.php?event_no=" + eventNo;
    }
</script>
</body>
</html>
