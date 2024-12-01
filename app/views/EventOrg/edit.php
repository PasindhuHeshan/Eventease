<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    <div class="event">
        <h2>Edit Event</h2>
        <form action="" method="post">
            <h3>General Details</h3>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="venue">Venue</label>
                <input type="text" name="venue" id="venue" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="supervisor">Supervisor</label>
                <input type="text" name="supervisor" id="supervisor" class="form-control">
            </div>
            <div class="form-group">
                <label for="participant_cap">Participant Cap</label>
                <input type="number" name="participant_cap" id="participant_cap" class="form-control">
            </div>
            <div class="form-group">
                <label for="target_audience">Target Audience</label>
                <input type="text" name="target_audience" id="target_audience" class="form-control">
            </div>
            <button type="submit" class="btn primary">Update</button>
            <br></br>

            <h3>Management Staff Details</h3>
            <div id="staff-container">
                <div class="form-group">
                    <label for="role_1">Role</label>
                    <input type="text" name="role_1" id="role_1" class="form-control" value="Organizer" readonly>
                </div>
                <div class="form-group">
                    <label for="name_1">Name</label>
                    <input type="text" name="name_1" id="name_1" class="form-control" value="Auto-loaded Name" readonly>
                </div>
            </div>
            <button type="button" class="btn primary" onclick="addStaff()">Add Staff</button>
            <br></br>

            <h3>Notification Management</h3>
            <div class="form-group">
                <label for="notification_title">Title</label>
                <input type="text" name="notification_title" id="notification_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="notification_description">Description</label>
                <textarea name="notification_description" id="notification_description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="notification_receivers">Receivers</label>
                <input type="text" name="notification_receivers" id="notification_receivers" class="form-control" required>
            </div>
            <button type="submit" class="btn primary">Send Notification</button>
            <br></br>

            <h3>Inventory Management</h3>
            <div class="form-group">
                <label for="inventory_name">Item</label>
                <select name="inventory_name" id="inventory_name" class="form-control" required>
                    <option value="Chairs">Chairs</option>
                    <option value="Tables">Tables</option>
                    <option value="Projector">Projector</option>
                    <option value="Microphone">Microphone</option>
                    <option value="Speakers">Speakers</option>
                    <!-- Add more items as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="inventory_quantity">Quantity</label>
                <input type="number" name="inventory_quantity" id="inventory_quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn primary">Request Item</button>
        </form>
    </div>
</div>