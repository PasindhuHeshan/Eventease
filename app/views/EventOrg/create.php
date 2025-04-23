<link rel="stylesheet" type="text/css" href="./css/global.css">
<style>
    /* Add styles for supervisor search */
    #supervisor {
        margin-left: 100px;
    }

    .supervisor-search-container {
        position: relative;
        width: 100%; /* Ensure the container takes full width */
    }

    #supervisorSearch {
        width: 80%; /* Ensure the input takes full width */
    }

    .supervisor-results {
        position: absolute;
        width: 80%; /* Match the width of the input */
        max-height: 200px;
        overflow-y: auto;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        z-index: 1000;
        display: none;
    }

    .supervisor-result-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .supervisor-result-item:hover {
        background-color: #f0f0f0;
    }
</style>
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
                <label for="time">Starting Time</label>
                <input type="time" name="time" id="time" class="form-control" value="<?php echo isset($eventData['time']) ? $eventData['time'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="time">Finishing Time</label>
                <input type="time" name="time" id="time" class="form-control" value="<?php echo isset($eventData['finish_time']) ? $eventData['finish_time'] : ''; ?>" required>
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
            <div class="form-group">
                <label for="long_dis">Description</label>
                <textarea name="long_dis" id="long_dis" class="form-control" required><?php echo isset($eventData['long_dis']) ? $eventData['long_dis'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label id ="supervisor"for="supervisor">Supervisor</label>
                <div class="supervisor-search-container">
                    <input type="text" id="supervisorSearch" class="form-control" placeholder="Search Supervisor..." autocomplete="off">
                    <input type="hidden" name="supervisor" id="selectedSupervisorId">
                    <div id="supervisorResults" class="supervisor-results"></div>
                </div>
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

document.addEventListener("DOMContentLoaded", function() {
    const supervisorSearch = document.getElementById('supervisorSearch');
    const supervisorResults = document.getElementById('supervisorResults');
    const selectedSupervisorId = document.getElementById('selectedSupervisorId');
    
    // Sample supervisor data (replace with your actual PHP data)
    const supervisors = [
        <?php foreach ($supervisors as $sup): ?>{
            id: "<?php echo $sup['No']; ?>",
            name: "<?php echo $sup['fname'] . ' ' . $sup['lname']; ?>"
        },
        <?php endforeach; ?>
    ];

    // Function to filter and display results
    function searchSupervisors(query) {
        supervisorResults.innerHTML = '';
        
        if (query.length < 2) {
            supervisorResults.style.display = 'none';
            return;
        }
        
        const filtered = supervisors.filter(sup => 
            sup.name.toLowerCase().includes(query.toLowerCase())
        );
        
        if (filtered.length === 0) {
            const noResults = document.createElement('div');
            noResults.className = 'supervisor-result-item';
            noResults.textContent = 'No supervisors found';
            supervisorResults.appendChild(noResults);
        } else {
            filtered.forEach(sup => {
                const item = document.createElement('div');
                item.className = 'supervisor-result-item';
                item.textContent = sup.name;
                item.dataset.id = sup.id;
                item.addEventListener('click', function() {
                    supervisorSearch.value = sup.name;
                    selectedSupervisorId.value = sup.id;
                    supervisorResults.style.display = 'none';
                });
                supervisorResults.appendChild(item);
            });
        }
        
        supervisorResults.style.display = 'block';
    }

    // Event listeners
    supervisorSearch.addEventListener('input', function() {
        searchSupervisors(this.value);
    });
    
    // Hide results when clicking outside
    document.addEventListener('click', function(e) {
        if (!supervisorSearch.contains(e.target) && !supervisorResults.contains(e.target)) {
            supervisorResults.style.display = 'none';
        }
    });
    
    // If editing an event with existing supervisor, pre-fill the field
    <?php if (isset($eventData['supervisor']) && $eventData['supervisor']): ?>
        const existingSup = supervisors.find(sup => sup.id == "<?php echo $eventData['supervisor']; ?>");
        if (existingSup) {
            supervisorSearch.value = existingSup.name;
            selectedSupervisorId.value = existingSup.id;
        }
    <?php endif; ?>
});
</script>

