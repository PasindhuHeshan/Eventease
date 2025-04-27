
<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    <h2>Event Report: <?= htmlspecialchars($event->name) ?></h2>
    <div class="report">
        <h3>Event Details</h3>
        <div class="event-details">
            <p><strong>Date:</strong> <?= htmlspecialchars($event->date) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($event->time) ?></p>
            <p><strong>Venue:</strong> <?= htmlspecialchars($event->location) ?></p>
            <p><strong>Type:</strong> <?= htmlspecialchars($event->event_type) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($event->long_dis) ?></p>
            <p><strong>Supervisor:</strong> <?= htmlspecialchars($event->supervisor) ?></p>
            <p><strong>Participant Cap:</strong> <?= htmlspecialchars($event->people_limit) ?></p>
            <p><strong>Target Audience:</strong> 
                <?= $event->flag == 1 ? 'Open to everyone' : ($event->flag == 2 ? 'Open to University Students' : 'Unknown') ?>
            </p> </div>
        
        <h3>Management Staff</h3>
        <ul>
            <li>Organizer - <?= $org['fname']." ".$org['lname'] ?></li>
            <?php foreach ($managementStaff as $staff): ?>
                <li><?= htmlspecialchars($staff['event_role']) ?> - <?= htmlspecialchars($staff['fname']." ".$staff['lname']) ?></li>
            <?php endforeach; ?>
        </ul>
        
        <h3>Statistics</h3>
        <div class="statistics">
            <p><strong>Total Enrolled:</strong> <?= $data['enrolled'] ?></p>
            <p><strong>Total Participated:</strong> <?= $data['participated'] ?></p>
            <p><strong>Participation Percentage:</strong> <?= number_format($data['participation_percentage'], 2) ?>%</p>
            <p><strong>Total Rating:</strong> <?= number_format($data['total_rating'], 1) ?>/5 (from <?= $data['reviews_count'] ?> reviews)</p>
            <p><strong>Reached Audience:</strong> <?= $data['reached_audience'] ?></p>
            <p><strong>Total Reach Percentage:</strong> <?= number_format($data['reach_percentage'], 2) ?>%</p>
        </div>
        
        <h3>Additional Remarks</h3>
        <p><?= htmlspecialchars($remarks['fname']." ".$remarks['lname']) ?> - <?= htmlspecialchars($remarks['remark']);?></p>

        <div class="actions">
            <button type="button" class="btn primary">Edit</button>
            <break></break>
            <button type="button" class="btn primary">Export as pdf</button>
        </div>
    </div>
</div>