<link rel="stylesheet" type="text/css" href="./css/global.css">

<style>
    /* Supervisor Search Styles - Perfectly aligned with other form fields */
    .form-group {
        display: flex;
        flex-direction: row;
        margin-bottom: 15px;
        align-items: center;
    }

    .form-group label {
        font-size: 18px;
        font-weight: bold;
        text-align: right;
        width: 150px;
        padding-right: 20px;
        margin-left: auto; /* Pushes label to right */
    }

    .form-group .form-control,
    .form-group .supervisor-search-container {
        width: 70%;
        margin-right: 100px;
    }

    /* Supervisor-specific styles */
    .supervisor-search-container {
        position: relative;
    }

    #supervisorSearch {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .supervisor-results {
        position: absolute;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        z-index: 1000;
        display: none;
        top: 100%;
        left: 0;
    }

    .supervisor-result-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .supervisor-result-item:hover {
        background-color: #f0f0f0;
    }

    #createEventPage {
    max-width: 900px;
    margin: 30px auto;
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

#createEventPage h2 {
    color: #2c3e50;
    font-size: 28px;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eaeaea;
    text-align: center;
}

#createEventPage .event {
    padding: 0;
}

#createEventPage form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

#createEventPage .form-group {
    display: flex;
    flex-direction: row;
    margin-bottom: 15px;
    align-items: center;
}

#createEventPage .form-group label {
    font-size: 16px;
    font-weight: 600;
    color: #34495e;
    text-align: right;
    width: 180px;
    padding-right: 25px;
    margin-left: auto;
}

#createEventPage .form-control {
    flex: 1;
    padding: 12px 15px;
    font-size: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
    margin-right: 100px;
}

#createEventPage .form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    background-color: white;
    outline: none;
}

#createEventPage textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

#createEventPage select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
}

#createEventPage .btn {
    align-self: center;
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 15px;
}

#createEventPage .btn.primary {
    background-color: #3498db;
    color: white;
    border: none;
}

#createEventPage .btn.primary:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(41, 128, 185, 0.2);
}

#createEventPage .downbuttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 25px;
}

#createEventPage .btn.danger {
    background-color: #e74c3c;
    color: white;
    border: none;
}

#createEventPage .btn.danger:hover {
    background-color: #c0392b;
}

#createEventPage input[type="file"] {
    padding: 10px;
    background: white;
}

#createEventPage .supervisor-search-container {
    position: relative;
    flex: 1;
    margin-right: 100px;
}

/* Target Audience Select Styles */
#createEventPage #target_audience {
    flex: 1;
    padding: 12px 15px;
    font-size: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
    margin-right: 100px;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    cursor: pointer;
}

#createEventPage #target_audience:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    background-color: white;
    outline: none;
}

#createEventPage #target_audience option {
    padding: 10px 15px;
    background: white;
    color: #34495e;
}

#createEventPage #target_audience option:hover {
    background-color: #3498db;
    color: white;
}

/* For the form-group container specifically for target audience */
#createEventPage .form-group:has(#target_audience) {
    align-items: center;
}

</style>

<div class="page"id="createEventPage">
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
                <input type="time" name="finish_time" id="finish_time" class="form-control" value="<?php echo isset($eventData['finish_time']) ? $eventData['finish_time'] : ''; ?>" required>
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
                <label for="supervisorSearch">Supervisor</label>
                <div class="supervisor-search-container">
                    <input type="text" id="supervisorSearch" name="supervisor" class="form-control" autocomplete="off">
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
</div><script>
document.getElementById('event_banner').addEventListener('change', function() {
    var fileName = this.files[0].name;
    document.getElementById('file-name').textContent = fileName;
});

document.addEventListener("DOMContentLoaded", function() {
    const supervisorSearch = document.getElementById('supervisorSearch');
    const supervisorResults = document.getElementById('supervisorResults');
    const supervisorInput = document.querySelector('input[name="supervisor"]'); 
    const supervisors = [
        <?php foreach ($supervisors as $sup): ?>{
            id: "<?php echo $sup['No']; ?>",
            name: "<?php echo $sup['fname'] . ' ' . $sup['lname']; ?>"
        },
        <?php endforeach; ?>
    ];

    
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
                    supervisorInput.dataset.selectedId = sup.id; 
                    supervisorResults.style.display = 'none';
                });
                supervisorResults.appendChild(item);
            });
        }

        supervisorResults.style.display = 'block';
    }

    
    supervisorSearch.addEventListener('input', function() {
        searchSupervisors(this.value);
        
        delete supervisorInput.dataset.selectedId;
    });

    
    const eventForm = document.querySelector('form');
    eventForm.addEventListener('submit', function() {
        if (supervisorInput.dataset.selectedId) {
            supervisorInput.value = supervisorInput.dataset.selectedId;
        }
    });

    
    document.addEventListener('click', function(e) {
        if (!supervisorSearch.contains(e.target) && !supervisorResults.contains(e.target)) {
            supervisorResults.style.display = 'none';
        }
    });

    
    <?php if (isset($eventData['supervisor']) && $eventData['supervisor']): ?>
        const existingSup = supervisors.find(sup => sup.id == "<?php echo $eventData['supervisor']; ?>");
        if (existingSup) {
            supervisorSearch.value = existingSup.name;
            supervisorInput.dataset.selectedId = existingSup.id; // Store the ID
        }
    <?php endif; ?>
});
</script>