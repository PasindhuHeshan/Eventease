<link rel="stylesheet" type="text/css" href="./css/global.css">

<div class="page">
    <h2>Event Enrollment and Attendance</h2>
    <?php if (empty($enrolled_people)): ?>
        <div class="alert warning">
            No attendees have enrolled for this event.
        </div>
        <?php 
        print_r($enrolled_people);
        ?>
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
