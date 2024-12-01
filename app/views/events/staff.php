<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event 1  Requests</title>
    <link rel="stylesheet" href="./css/staffstyles.css">
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
                            <th>Event Organizer</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Accept</th>
                            <th>Reason for rejection</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><a href="event.php?no=<?= $event['no'] ?>"><?= $event['name'] ?></a></td>
                                <td><?= $event['organizer'] ?></td>
                                <td><?= $event['location'] ?></td>
                                <td><?= $event['date'] ?></td>
                                <td><?= $event['time'] ?></td>
                                <td><form action="acceptevent" method="post"><input type="text" name="no" value="<?php echo $event['no'] ?>" hidden><button type="submit" class="accept">Accept</button></form></td>
                                <td><textarea placeholder="Reason for rejection" rows="3"></textarea></td>
                                <td>
                                        <button type="button" class="reject">Reject</button>
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