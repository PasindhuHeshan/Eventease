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
            <h2>Event Inquiries</h2>
            <?php if (empty($eventreviews)): ?>
                <div class="alert warning">
                    No inquiries for this event.
                </div>
            <?php endif; ?>
            <div class="events">
                <?php foreach ($eventreviews as $review) { ?>
                    <div class="event">
                    <form action="process_send_email" method="post">
                    <!-- <div class="form-group">
                        <label for="event">Event</label>
                        <input type="text" name="event" id="event" class="form-control" required value="<?php echo $review['name']; ?>">
                    </div> -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required value="<?php echo $review['fname']." ".$review['lname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inquiry">Inquiry</label>
                        <textarea name="inquiry" id="inquiry" class="form-control" required><?php echo $review['message']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inquiry">Reply</label>
                        <textarea name="email_body" id="message" class="form-control" required rows=4></textarea>
                    </div>
                    <input type="hidden" id="inq_no" name="inq_no" value="<?php echo $review['inq_no']; ?>">
                    <input type="hidden" id="event_no" name="event_no" value="<?php echo $review['event_no']; ?>">
                    <input type="hidden" id="name" name="name" value="<?php echo htmlspecialchars($review['fname']); ?>">
                    <input type="hidden" id="email" name="recipient_email" value="<?php echo htmlspecialchars($review['email']); ?>">
                    <input type="hidden" name="subject" value="About your Inquiry!">
                    <input type="text" name="purpose" value="01" hidden>
                    <button type="submit" class="btn primary" name="send_email">Reviewed</button>
                </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

