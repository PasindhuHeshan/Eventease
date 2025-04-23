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
                            <tr>
                                <td><a href="eventd.php?no=<?= $event['no'] ?>"><?= $event['name'] ?></a></td>
                                <td><?= $event['orgname'] ?></td>
                                <td><?= $event['fname']." ".$event['lname'] ?></td>
                                <td><?= $event['location'] ?></td>
                                <td><?= $event['date'] ?></td>
                                <td><?= $event['time'] ?></td>
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