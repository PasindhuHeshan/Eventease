<?php
// Dummy data for testing
$event = (object) [
    'name' => 'Annual Tech Conference',
    'date' => '2023-10-15',
    'time' => '10:00 AM',
    'venue' => 'Convention Center',
    'type' => 'Conference',
    'description' => 'A conference about the latest in technology.',
    'supervisor' => 'John Doe',
    'participant_cap' => 500,
    'target_audience' => 'Tech Enthusiasts'
];

$managementStaff = [
    (object) ['name' => 'Alice Smith', 'role' => 'Coordinator'],
    (object) ['name' => 'Bob Johnson', 'role' => 'Assistant Coordinator']
];

$statistics = [
    'enrolled' => 450,
    'participated' => 400,
    'participation_percentage' => 88.89,
    'total_rating' => 4.5,
    'reached_audience' => 300,
    'reach_percentage' => 60.00
];

$remarks = 'The event was a great success with high participation and positive feedback.';
?>
<link rel="stylesheet" type="text/css" href="global.css">
<div class="page">
    <h2>Event Report: <?= htmlspecialchars($event->name) ?></h2>
    <div class="report">
        <h3>Event Details</h3>
        <div class="event-details">
            <p><strong>Date:</strong> <?= htmlspecialchars($event->date) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($event->time) ?></p>
            <p><strong>Venue:</strong> <?= htmlspecialchars($event->venue) ?></p>
            <p><strong>Type:</strong> <?= htmlspecialchars($event->type) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($event->description) ?></p>
            <p><strong>Supervisor:</strong> <?= htmlspecialchars($event->supervisor) ?></p>
            <p><strong>Participant Cap:</strong> <?= htmlspecialchars($event->participant_cap) ?></p>
            <p><strong>Target Audience:</strong> <?= htmlspecialchars($event->target_audience) ?></p>
        </div>
        
        <h3>Management Staff</h3>
        <ul>
            <!-- <?php foreach ($managementStaff as $staff): ?>
                <li><?= htmlspecialchars($staff->name) ?> - <?= htmlspecialchars($staff->role) ?></li>
            <?php endforeach; ?> -->
        </ul>
        
        <h3>Statistics</h3>
        <div class="statistics">
            <p><strong>Total Enrolled:</strong> <?= $statistics['enrolled'] ?></p>
            <p><strong>Total Participated:</strong> <?= $statistics['participated'] ?></p>
            <p><strong>Participation Percentage:</strong> <?= number_format($statistics['participation_percentage'], 2) ?>%</p>
            <p><strong>Total Rating:</strong> <?= number_format($statistics['total_rating'], 1) ?>/5</p>
            <p><strong>Reached Audience:</strong> <?= $statistics['reached_audience'] ?></p>
            <p><strong>Total Reach Percentage:</strong> <?= number_format($statistics['reach_percentage'], 2) ?>%</p>
        </div>
        
        <h3>Additional Remarks</h3>
        <p><?= htmlspecialchars($remarks) ?></p>

        <div class="actions">
            <button type="button" class="btn primary">Edit</button>
            <break></break>
            <button type="button" class="btn primary">Export as pdf</button>
        </div>
    </div>
</div>