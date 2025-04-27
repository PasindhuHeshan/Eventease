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
            <h2>Event Reviews</h2>
            <?php if (empty($eventinq)): ?>
                <div class="alert warning">
                    No reviews for this event.
                </div>
            <?php endif; ?>
            <div class="events">
                <?php foreach ($eventinq as $review) { ?>
                    <div class="event">
                        <form action="process_send_email" method="post">
                            <input type="hidden" id="rev_no" name="rev_no" value="<?php echo $review['review_no']; ?>">
                            <input type="hidden" id="event_no" name="event_no" value="<?php echo $review['event_no']; ?>">
                            <input type="hidden" id="name" name="name" value="<?php echo htmlspecialchars($review['fname']); ?>">
                            <input type="hidden" id="email" name="recipient_email" value="<?php echo htmlspecialchars($review['email']); ?>">
                            <input type="hidden" name="subject" value="About your Inquiry!">
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>