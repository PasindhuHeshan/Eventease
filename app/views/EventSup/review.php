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
            <h2>Event Reviews</h2>
            <?php if (empty($eventinq)): ?>
                <div class="alert warning">
                    No reviews for this event.
                </div>
            <?php else: ?>
                <div class="events">
                    <?php foreach ($eventinq as $review): ?>
                        <form action="process_send_email" method="post">
                            <div class="event">
                                <!-- <div class="form-group">
                                    <label for="event">Event</label>
                                    <input type="text" name="event" id="event" class="form-control" required value="<?php echo $review['name']; ?>">
                                </div> -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required value="<?php echo $review['fname'] . " " . $review['lname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="inquiry">Review</label>
                                    <textarea name="inquiry" id="inquiry" class="form-control" required><?php echo $review['review']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <input type="text" name="rating" id="rating" class="form-control" required value="<?php echo $review['rating']; ?>">
                                </div>
                                <input type="hidden" id="rev_no" name="rev_no" value="<?php echo $review['review_no']; ?>">
                                <input type="hidden" id="event_no" name="event_no" value="<?php echo $review['event_no']; ?>">
                                <input type="hidden" id="email" name="recipient_email" value="<?php echo htmlspecialchars($review['email']); ?>">
                                <input type="text" name="purpose" value="02" hidden>
                                <button type="submit" class="btn primary" name="send_email">Reviewed</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>