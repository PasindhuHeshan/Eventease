<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    <div class="event">
        <h2><?php echo isset($eventData) ? 'Edit Event' : 'Create Event'; ?></h2>
        <form action="<?php echo !$eventData ? 'createevent' : 'processEvent'; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="eventno" value="<?php echo isset($eventData['no']) ? $eventData['no'] : ''; ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($eventData['name']) ? $eventData['name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo isset($eventData['date']) ? $eventData['date'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" name="time" id="time" class="form-control" value="<?php echo isset($eventData['time']) ? $eventData['time'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="venue">Venue</label>
                <input type="text" name="location" id="venue" class="form-control" value="<?php echo isset($eventData['location']) ? $eventData['location'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="event_type">Type</label>
                <select name="event_type" id="event_type" class="form-control" required>
                    <option value="">Select Type</option>
                    <option value="Social" <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Social') ? 'selected' : ''; ?>>Social</option>
                    <option value="Educational" <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Educational') ? 'selected' : ''; ?>>Educational</option>
                    <option value="Entertainment" <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Entertainment') ? 'selected' : ''; ?>>Entertainment</option>
                    <option value="Culture" <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Culture') ? 'selected' : ''; ?>>Culture</option>
                    <option value="Charity" <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Charity') ? 'selected' : ''; ?>>Charity</option>
                    <option value="Music" <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Music') ? 'selected' : ''; ?>>Music</option>
                </select>
            </div>
            <!-- <div class="form-group">
                <label for="short_dis">Short Description</label>
                <textarea name="short_dis" id="short_dis" class="form-control" required><?php echo isset($eventData['short_dis']) ? $eventData['short_dis'] : ''; ?></textarea>
            </div> -->
            <div class="form-group">
                <label for="long_dis">Long Description</label>
                <textarea name="long_dis" id="long_dis" class="form-control" required><?php echo isset($eventData['long_dis']) ? $eventData['long_dis'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="supervisor">Supervisor</label>
                <select name="supervisor" id="supervisor" class="form-control" required>
                    <option value="">Select Supervisor</option>
                    <?php foreach ($supervisors as $sup): ?>
                        <option value="<?php echo $sup['No']; ?>" <?php echo (isset($eventData['supervisor']) && $eventData['supervisor'] == $sup['No']) ? 'selected' : ''; ?>><?php echo $sup['fname']." ".$sup['lname']; ?></option>
                    <?php endforeach; ?>

                    
                </select>
            </div>
            <div class="form-group">
                <label for="participant_cap">Participant Cap</label>
                <input type="number" name="people_limit" id="participant_cap" class="form-control" value="<?php echo isset($eventData['people_limit']) ? $eventData['people_limit'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="target_audience">Target Audience</label>
                <select name="flag" id="target_audience" class="form-select" required>
                    <option value="0" <?php echo (isset($eventData['flag']) && $eventData['flag'] == '0') ? 'selected' : ''; ?>>Students</option>
                    <option value="1" <?php echo (isset($eventData['flag']) && $eventData['flag'] == '1') ? 'selected' : ''; ?>>All</option>
                </select>
            </div>
            <div class="form-group">
                <label for="event_banner">Event Banner</label>
                <input type="file" name="event_banner" id="event_banner" class="form-control">
            </div>
            <?php if (isset($eventData['event_banner'])): ?>
                <input type="hidden" name="existing_event_banner" value="<?php echo $eventData['event_banner']; ?>">
                <p>Current Event Banner - <?php echo basename($eventData['event_banner']); ?></p>
            <?php endif; ?>
            <input type="number" name="pending" id="pending" value="0" hidden>
            <input type="text" name="organizer" value="<?php echo $_SESSION['username']; ?>" hidden>
            <?php if (isset($eventData)) { ?>
            <div class="downbuttons">
                <button type="submit" name="update" class="btn primary">Update Event</button>
                <button class="btn primary"><a href="addmore" style="color:white">Add More Setting</a></button>
                <button type="submit" name="delete" class="btn danger">Delete Event</button>
            </div>
            <?php } else { ?>
                <button type="submit" name="submit" class="btn primary">Create Event</button>
            <?php } ?>
        </form>
    </div>
</div>

<script>
document.getElementById('event_banner').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').textContent = fileName;
});
</script>
