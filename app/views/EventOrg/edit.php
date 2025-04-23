<link rel="stylesheet" type="text/css" href="./css/global.css">
<style>
    .content-section { display: none; }
    .content-section.active { display: block; }

    #special {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 0px;
    }
    /* Management Staff Search Styles */
    .management-staff-search-container {
        position: relative;
        width: 100%;
    }

    #userSearch {
        width: 80%;
    }

    .management-staff-results {
        position: absolute;
        width: 80%;
        max-height: 200px;
        overflow-y: auto;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        z-index: 1000;
        display: none;
    }

    .management-staff-result-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .management-staff-result-item:hover {
        background-color: #f0f0f0;
    }
</style>
<h2 id="special">Edit Event</h2>
<div class="page">
    <div class="sidebar">
        <ul>
            <li data-target="general-details">General Details</li>
            <li data-target="management-staff-details">Management Staff Details</li>
            <li data-target="notification-management">Notification Management</li>
            <li data-target="inventory-management">Inventory Management</li>
        </ul>
    </div>
    <div class="content">
        <div class="event">
            <form action="processEvent" method="post" enctype="multipart/form-data" id="eventForm">
                <!-- General Details Section -->
                <div id="general-details" class="content-section active">
                    <h3>General Details</h3>
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
                        <textarea rows="5" name="long_dis" id="long_dis" class="form-control" required><?php echo isset($eventData['long_dis']) ? $eventData['long_dis'] : ''; ?></textarea>
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
                    <button type="submit" name="update_details" class="btn primary">Update</button>
                </div>

                <!-- Management Staff Details Section -->
                <div id="management-staff-details" class="content-section">
                    <h3>Management Staff Details</h3>
                    <div id="staff-container">
                        <div class="form-group" id="staff_1">
                            <label for="role_1">Role</label>
                            <select name="role_1" id="role_1" class="form-control" required disabled>
                                <option value="Organizer">Organizer</option>
                                <option value="Coordinator">Coordinator</option>
                                <option value="Volunteer">Volunteer</option>
                                <option value="Manager">Manager</option>
                                <option value="Treasurer">Treasurer</option>
                            </select>
                            <label for="name_1">Name</label>
                            <div class="management-staff-search-container">
                                <input type="text" id="userSearch_1" class="form-control" placeholder="Search Staff..." autocomplete="off">
                                <input type="hidden" name="staff_id_1" id="selectedStaffId_1">
                                <div id="staffResults_1" class="management-staff-results"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-row">
                        <button type="button" class="btn secondary" onclick="addStaff()">Add Staff</button>
                        <button type="submit" name="update_staff" class="btn primary">Update</button>
                    </div>
                </div>

                <!-- Notification Management Section -->
                <div id="notification-management" class="content-section">
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
                    <button type="submit" name="send_notification" class="btn primary">Send Notification</button>
                </div>

                <!-- Inventory Management Section -->
                <div id="inventory-management" class="content-section">
                    <h3>Inventory Management</h3>
                    <div id="inventory-container">
                        <div class="form-group" id="inventory_1">
                            <label for="inventory_name_1">Item Type</label>
                            <select name="inventory_name_1" id="inventory_name_1" class="form-control" required>
                                <option value="Electronics">Electronics</option>
                                <option value="Appliances">Appliances</option>
                                <option value="Furniture">Furniture</option>
                                <option value="Stationery">Stationery</option>
                            </select>
                            <label for="inventory_quantity_1">Quantity</label>
                            <input type="number" name="inventory_quantity_1" id="inventory_quantity_1" class="form-control" required>
                        </div>
                    </div>
                    <div class="button-row">
                        <button type="button" class="btn secondary" onclick="addInventory()">Add Item</button>
                        <button type="submit" name="request_inventory" class="btn primary">Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarItems = document.querySelectorAll(".sidebar li");
        const sections = document.querySelectorAll(".content-section");
        const staffContainer = document.getElementById("staff-container");
        const inventoryContainer = document.getElementById("inventory-container");
        let staffCount = 1; // Initial staff member
        let inventoryCount = 1; // Initial inventory item
        const maxStaff = 10; // Maximum staff members allowed
        const maxInventory = 10; // Maximum inventory items allowed

        // Sample staff data (replace with your actual PHP data)
        const staffMembers = [
            <?php foreach ($staffMembers as $staff): ?> {
                id: "<?php echo $staff['No']; ?>",
                name: "<?php echo $staff['fname'] . ' ' . $staff['lname']; ?>"
            },
            <?php endforeach; ?>
        ];

        // Add this to your script section in edit.php
        document.getElementById('eventForm').addEventListener('submit', function(e) {
            const submitButton = e.submitter;
            if (submitButton.name === 'update_details' || 
                submitButton.name === 'update_staff' || 
                submitButton.name === 'send_notification' || 
                submitButton.name === 'request_inventory') {
                return true; // Allow form submission
            }
            e.preventDefault(); // Prevent form submission for other buttons
        });

        function showSection(id) {
            sections.forEach(section => {
                section.classList.remove("active");
                if (section.id === id) {
                    section.classList.add("active");
                }
            });
        }

        sidebarItems.forEach(item => {
            item.addEventListener("click", () => {
                const targetId = item.getAttribute("data-target");
                showSection(targetId);
            });
        });

        // Function to initialize search for a staff member
        function initStaffSearch(index) {
            const userSearch = document.getElementById(`userSearch_${index}`);
            const staffResults = document.getElementById(`staffResults_${index}`);
            const selectedStaffId = document.getElementById(`selectedStaffId_${index}`);

            function searchStaff(query) {
                staffResults.innerHTML = '';
                
                if (query.length < 2) {
                    staffResults.style.display = 'none';
                    return;
                }
                
                const filtered = staffMembers.filter(staff => 
                    staff.name.toLowerCase().includes(query.toLowerCase())
                );
                
                if (filtered.length === 0) {
                    const noResults = document.createElement('div');
                    noResults.className = 'management-staff-result-item';
                    noResults.textContent = 'No staff members found';
                    staffResults.appendChild(noResults);
                } else {
                    filtered.forEach(staff => {
                        const item = document.createElement('div');
                        item.className = 'management-staff-result-item';
                        item.textContent = staff.name;
                        item.dataset.id = staff.id;
                        item.addEventListener('click', function() {
                            userSearch.value = staff.name;
                            selectedStaffId.value = staff.id;
                            staffResults.style.display = 'none';
                        });
                        staffResults.appendChild(item);
                    });
                }
                
                staffResults.style.display = 'block';
            }

            userSearch.addEventListener('input', function() {
                searchStaff(this.value);
            });
            
            document.addEventListener('click', function(e) {
                if (!userSearch.contains(e.target) && !staffResults.contains(e.target)) {
                    staffResults.style.display = 'none';
                }
            });
        }

        window.addStaff = function () {
            if (staffCount >= maxStaff) {
                alert("You can only add up to 10 staff members.");
                return;
            }
            staffCount++;
            const staffHtml = `
                <div class="form-group" id="staff_${staffCount}">
                    <label for="role_${staffCount}">Role</label>
                    <select name="role_${staffCount}" id="role_${staffCount}" class="form-control" required>
                        <option value="Coordinator">Coordinator</option>
                        <option value="Volunteer">Volunteer</option>
                        <option value="Manager">Manager</option>
                        <option value="Treasurer">Treasurer</option>
                    </select>
                    <label for="name_${staffCount}">Name</label>
                    <div class="management-staff-search-container">
                        <input type="text" id="userSearch_${staffCount}" class="form-control" placeholder="Search Staff..." autocomplete="off">
                        <input type="hidden" name="staff_id_${staffCount}" id="selectedStaffId_${staffCount}">
                        <div id="staffResults_${staffCount}" class="management-staff-results"></div>
                    </div>
                    <button type="button" class="btn danger" onclick="removeStaff(${staffCount})">Remove</button>
                </div>
            `;
            staffContainer.insertAdjacentHTML("beforeend", staffHtml);
            
            // Initialize search for the new staff member
            initStaffSearch(staffCount);
        };

        window.removeStaff = function (id) {
            const staffElement = document.getElementById(`staff_${id}`);
            if (staffElement) {
                staffElement.remove();
                staffCount--;
            }
        };

        window.addInventory = function () {
            if (inventoryCount >= maxInventory) {
                alert("You can only add up to 10 inventory items.");
                return;
            }
            inventoryCount++;
            const inventoryHtml = `
                <div class="form-group" id="inventory_${inventoryCount}">
                    <label for="inventory_name_${inventoryCount}">Item Type</label>
                    <select name="inventory_name_${inventoryCount}" id="inventory_name_${inventoryCount}" class="form-control" required>
                        <option value="Electronics">Electronics</option>
                        <option value="Appliances">Appliances</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Stationery">Stationery</option>
                    </select>
                    <label for="inventory_quantity_${inventoryCount}">Quantity</label>
                    <input type="number" name="inventory_quantity_${inventoryCount}" id="inventory_quantity_${inventoryCount}" class="form-control" required>
                    <button type="button" class="btn danger" onclick="removeInventory(${inventoryCount})">Remove</button>
                </div>
            `;
            inventoryContainer.insertAdjacentHTML("beforeend", inventoryHtml);
        };

        window.removeInventory = function (id) {
            const inventoryElement = document.getElementById(`inventory_${id}`);
            if (inventoryElement) {
                inventoryElement.remove();
                inventoryCount--;
            }
        };

        // Initialize search for the first staff member
        initStaffSearch(1);
    });
</script>

<style>
/* Add some basic styling for the sidebar and content */
.button-row {
    display: flex;
    gap: 10px; /* Add spacing between buttons */
    margin-top: 10px; /* Add some margin above the buttons */
}

.btn.primary {
    margin-left: auto;
    margin-right: 10%;
}
    

.page {
    display: flex;
}

.sidebar {
    width: 250px;
    height: fit-content;
    background-color: #f4f4f4;
    padding: 15px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin: 10px 0;
    cursor: pointer;
}

.content {
    width: 80%;
    padding: 20px;
}
</style>