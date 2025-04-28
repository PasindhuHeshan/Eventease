<link rel="stylesheet" type="text/css" href="./css/global.css">

<style>
.event-sup-container {
    display: flex;
    gap: 20px;
}

.sidebar {
    width: 250px;
    background-color: #87cefa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
}

.event-sup-content {
    flex: 1;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.attendance-status {
    margin-left: 10px;
    color: #28a745;
    font-weight: bold;
}

</style>

<div class="page">
    <div class="event-sup-container">
        <!-- Include Sidebar -->
        <?php include '../app/views/partials/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="event-sup-content">
            <h2>Event Enrollment and Attendance</h2>
            <?php if (empty($enrolled_people)): ?>
                <div class="alert warning">
                    No attendees have enrolled for this event.
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert success">
                    <?= htmlspecialchars($_SESSION['success_message']) ?>
                    <?php unset($_SESSION['success_message']) ?>
                </div>
            <?php endif; ?>

            <div class="enrollment">
                <form action="" method="post">  <!-- Changed action to empty string -->
                    <input type="hidden" name="eventNo" value="<?= $eventNo ?>">
                    <div class="form-group">
                    <ol>
                    <?php foreach ($enrolled_people as $person): ?>
                        <li>
                            <label for="attendee_<?= $person['id'] ?>">
                                <?= htmlspecialchars($person['name']) ?>
                                <!-- Add status indicator -->
                                <?php if ($person['attendance_status'] == 1): ?>
                                    <span class="attendance-status">(Attended ✓)</span>
                                <?php endif; ?>
                            </label>
                            <input 
                                type="checkbox" 
                                id="attendee_<?= $person['id'] ?>" 
                                name="attendance[]" 
                                value="<?= $person['username'] ?>"
                                <?= $person['attendance_status'] == 1 ? 'checked' : '' ?>
                            >
                            <input type="hidden" name="username[]" value="<?= $person['username'] ?>">
                        </li>
                    <?php endforeach; ?>
                    </ol>
                    </div>
                    <button type="submit" name="submit_attendance" class="btn primary">Submit Attendance</button>
                </form>
            </div>
        </div>
    </div>
</div>