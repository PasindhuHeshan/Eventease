<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    <h2>Event Inqueries</h2>
    <div class="events">
        <?php foreach ($eventreviews as $review) { ?>
            <div class="event">
                <form action="process_send_email" method="post">
                    <div class="form-group">
                        <label for="event">Event</label>
                        <input type="text" name="event" id="event" class="form-control" required value="<?php echo $review['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required value="<?php echo $review['fname']." ".$review['lname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inquiry">Inqueries</label>
                        <textarea name="inquiry" id="inquiry" class="form-control" required><?php echo $review['message']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inquiry">Message</label>
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

