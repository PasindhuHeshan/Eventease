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
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Eventease/app/views/partials/sidebar.php'; ?>

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
                    <?= isset($_SESSION['success_message']) ? htmlspecialchars($_SESSION['success_message']) : ''; unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <div class="enrollment">
                <form action="enrollment.php?eventNo=<?= $eventNo ?>" method="post">
                    <input type="hidden" name="eventNo" value="<?= $eventNo ?>">
                    <div class="form-group">
                        <ol>
                            <?php foreach ($enrolled_people as $person): ?>
                                <li>
                                    <label for="attendee_<?= $person['id'] ?>"><?= htmlspecialchars($person['name']) ?></label>
                                    <input 
                                        type="checkbox" 
                                        id="attendee_<?= $person['id'] ?>" 
                                        name="attendance[]" 
                                        value="<?= $person['id'] ?>"
                                        <?= $person['attendance_status'] == 1 ? 'checked' : '' ?>
                                    >
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
