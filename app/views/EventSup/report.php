<link rel="stylesheet" type="text/css" href="./css/global.css">

<style>
.event-sup-container {
    display: flex; /* Use flexbox for side-by-side layout */
    gap: 20px; /* Add spacing between the sidebar and content */
}

.sidebar {
    width: 250px; /* Fixed width for the sidebar */
    background-color: #87cefa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    flex-shrink: 0; /* Prevent the sidebar from shrinking */
}

.event-sup-content {
    flex: 1; /* Allow the content to take up the remaining space */
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
</style>

<div class="page">
    <div class="event-sup-container">
        <!-- Include Sidebar -->
        <?php include '../app/views/partials/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="event-sup-content">
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
    </div>
</div>